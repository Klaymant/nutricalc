<?php
namespace Model\Repository;

require_once ('../src/Model/Repository/Repository.php');
require_once ('../src/Model/Entity/User.php');
require_once ('../src/Model/Entity/Training.php');
require_once ('../src/Model/Entity/Exercise.php');
use Model\Repository\Repository;
use Model\Entity\User;
use Model\Entity\Training;
use Model\Entity\Exercise;

class TrainingRepository extends Repository {
	const TRAININGS_IDS =
	"SELECT DISTINCT(t_id), t_date FROM `user`
	LEFT JOIN training ON t_fk_user_id = u_id
	WHERE t_fk_user_id =?
	ORDER BY t_date DESC";

	const MAKE_TRAINING =
	"SELECT t_id, t_date, t_shape, exo_c_name, exo_p_work_load, exo_p_rest, exo_p_nb_sets, exo_p_nb_reps, m_name
	FROM `user`
	LEFT JOIN training ON t_fk_user_id = u_id
	LEFT JOIN exercise_practice ON t_id = exo_p_fk_training_id
	LEFT JOIN exercise_catalog ON exo_p_fk_exercise_catalog_id = exo_c_id
	LEFT JOIN method ON exo_p_fk_method_id = m_id
	WHERE t_id=?";

	const INSERT_TRAINING =
	"INSERT INTO training (t_fk_user_id, t_date, t_shape)
	VALUES (?, ?, ?)";

	const INSERT_EXERCISE =
	"INSERT INTO exercise_practice (exo_p_fk_training_id, exo_p_fk_exercise_catalog_id, exo_p_work_load, exo_p_rest, exo_p_nb_sets, exo_p_nb_reps, exo_p_fk_method_id)
	VALUES (?, ?, ?, ?, ?, ?, ?)";

	const UPDATE_TRAINING =
	"UPDATE training
	SET t_date = ?, t_shape = ?
	WHERE t_id=?";

	public function getTrainingsIds($userId) {
		$query = self::TRAININGS_IDS;
		return $this->sqlMaker->make($query, 'fetchAll', [$userId]);
	}

	public function makeExercises($training) {
		$exercises = [];

		foreach ($training AS $exo) {
			array_push($exercises, new Exercise($exo['exo_c_name'], $exo['exo_p_work_load'], $exo['exo_p_rest'], $exo['exo_p_nb_sets'], $exo['exo_p_nb_reps'], $exo['m_name']));
		}
		return $exercises;
	}

	public function makeExercisesAsArray($training) {
		$exercises = [];

		foreach ($training AS $exo) {
			array_push($exercises,
				['exoName'=>$exo['exo_c_name'],
				'workLoad'=>$exo['exo_p_work_load'],
				'rest'=>$exo['exo_p_rest'],
				'nbSets'=>$exo['exo_p_nb_sets'],
				'nbReps'=>$exo['exo_p_nb_reps'],
				'method'=>$exo['m_name']]);
		}
		return $exercises;
	}

	public function makeTrainingByIdAsArray($trainingId) {
		$query = self::MAKE_TRAINING;
		$training = $this->sqlMaker->make($query, 'fetchAll', [$trainingId]);
		$exercises = $this->makeExercisesAsArray($training);
		return ['exercises'=>$exercises, 'date'=>$training[0]['t_date'], 'shape'=>$training[0]['t_shape'], 'id'=>$training[0]['t_id']];
	}

	public function makeTrainingById($trainingId) {
		$query = self::MAKE_TRAINING;
		$training = $this->sqlMaker->make($query, 'fetchAll', [$trainingId]);
		$exercises = $this->makeExercises($training);
		return new Training($exercises, $training[0]['t_date'], $training[0]['t_shape'], $training[0]['t_id']);
	}

	public function getLastTrainings($userId, $nbTrainings=NULL) {
		$trainingIds = $this->getTrainingsIds($userId, $nbTrainings);
		return $nbTrainings != NULL ? array_slice($trainingIds, 0, $nbTrainings) : $trainingIds;
	}

	public function makeLastTrainings($userId, $nbTrainings=NULL) {
		$trainingIds = $this->getLastTrainings($userId, $nbTrainings);
		$trainings = [];

		foreach ($trainingIds AS $trainingId) {
            array_push($trainings, $this->makeTrainingById($trainingId['t_id']));
        }
        return $trainings;
	}

	public function getAllTrainingsById($userId) {
		$trainingIds = $this->getTrainingsIds($userId);
		$myTrainings = [];

		foreach ($trainingIds as $trainingId) {
			$training = $this->makeTrainingById($trainingId['t_id']);
			array_push($myTrainings, $training);
		}
		return $myTrainings;
	}

	public function getAllExercisesInfo() {
		$query = "SELECT exo_c_id, exo_c_name FROM `exercise_catalog`";
		return $this->sqlMaker->make($query, "fetchAll");
	}

	public function getAllMethodsInfo() {
		$query = "SELECT m_id, m_name FROM `method`";
		return $this->sqlMaker->make($query, "fetchAll");
	}

	/*
	** INSERTING
	*/

	public function addExercise($exercise, $trainingId) {
		$query = self::INSERT_EXERCISE;
		$params = [$trainingId];
		foreach ($exercise as $exoData) {
			array_push($params, $exoData);
		}
		$this->sqlMaker->make($query, NULL, $params);
	}

	public function addListOfExercises($exercises, $trainingId) {
		foreach ($exercises as $exo) {
			$this->addExercise($exo, $trainingId);
		}
	}

	public function addTraining($userId, $training) {
		$query = self::INSERT_TRAINING;
		$params = [$userId, $training['trainingMeta']['date'], $training['trainingMeta']['shape']];
		$this->sqlMaker->make($query, NULL, $params);
		$trainingId = $this->sqlMaker->getLastId();
		$this->addListOfExercises($training['exos'], $trainingId);
	}

	/*
	** UPDATING
	*/

	public function updateTraining($trainingId, $training) {
		$this->deleteAllExercises($trainingId);
		$this->addListOfExercises($training['exos'], $trainingId);
		$query = self::UPDATE_TRAINING;
		$params = [$training['trainingMeta']['date'], $training['trainingMeta']['shape'], $trainingId];
		$this->sqlMaker->make($query, NULL, $params);
	}

	/*
	** DELETING
	*/

	public function deleteAllExercises($trainingId) {
		$query = "DELETE FROM exercise_practice WHERE exo_p_fk_training_id=?";
		$this->sqlMaker->make($query, NULL, [$trainingId]);
	}

	public function deleteTraining($trainingId) {
		$query = "DELETE FROM training WHERE t_id=?";
		$this->sqlMaker->make($query, NULL, [$trainingId]);
	}

	public function dateExists($userId, $date) {
		$query = "SELECT COUNT(*) as nb_date FROM training WHERE t_fk_user_id=? AND t_date=?";
		$params = [$userId, $date];
		$dateExists = $this->sqlMaker->make($query, 'fetch', $params);
		return ($dateExists['nb_date'] > 0) ? true : false;
	}
}