<?php
namespace Model;

require_once ('Model/Repository.php');
require_once ('Model/User.php');
require_once ('Model/Training.php');
require_once ('Model/Exercise.php');
require_once ('Utils/SqlShortcut.php');
use Model\Repository;
use Model\User;
use Model\Training;
use Model\Exercise;
use Utils\SqlTrainingShortcut;

class TrainingRepository extends Repository {

	public function getTrainingsIds($userId) {
		$query = SqlTrainingShortcut::SELECT_TRAININGS_IDS;
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
		$query = SqlTrainingShortcut::MAKE_TRAINING;
		$training = $this->sqlMaker->make($query, 'fetchAll', [$trainingId]);
		$exercises = $this->makeExercisesAsArray($training);
		return ['exercises'=>$exercises, 'date'=>$training[0]['t_date'], 'shape'=>$training[0]['t_shape'], 'id'=>$training[0]['t_id']];
	}

	public function makeTrainingById($trainingId) {
		$query = SqlTrainingShortcut::MAKE_TRAINING;
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
            array_push($trainings, $this->makeTrainingById($trainingId['id_trainings']));
        }
        return $trainings;
	}

	public function getAllTrainingsById($userId) {
		$trainingIds = $this->getTrainingsIds($userId);
		$myTrainings = [];

		foreach ($trainingIds as $trainingId) {
			$training = $this->makeTrainingById($trainingId['id_trainings']);
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
		$query = SqlTrainingShortcut::INSERT_EXERCISE;
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
		$query = SqlTrainingShortcut::INSERT_TRAINING;
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
		$query = SqlTrainingShortcut::UPDATE_TRAINING;
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