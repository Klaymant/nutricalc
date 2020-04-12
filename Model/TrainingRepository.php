<?php
namespace Model;

require_once ('Model/Repository.php');
require_once ('Model/User.php');
require_once ('Model/Training.php');
require_once ('Model/Exercise.php');
use Model\Repository;
use Model\User;
use Model\Training;
use Model\Exercise;

class TrainingRepository extends Repository {

	public function getTrainingsIds($userId) {
		$query = $this->queryRouter('selectTrainingIds');
		return $this->sqlMaker->make($query, 'fetchAll', [$userId]);
	}

	public function makeExoArray($training) {
		$exercises = [];

		foreach ($training AS $exo) {
			array_push($exercises, new Exercise($exo['exoName'], $exo['work_load'], $exo['rest'], $exo['nb_sets'], $exo['nb_reps'], $exo['methodName']));
		}
		return $exercises;
	}

	public function makeTrainingById($trainingId) {
		$query = $this->queryRouter('makeTraining');
		$training = $this->sqlMaker->make($query, 'fetchAll', [$trainingId]);
		$exercises = $this->makeExoArray($training);
		return new Training($exercises, $training[0]['date'], $training[0]['shape'], $training[0]['id']);
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
		$query = "SELECT id, name FROM `exercise_catalog`";
		return $this->sqlMaker->make($query, "fetchAll");
	}

	public function getAllMethodsInfo() {
		$query = "SELECT id, name FROM `method`";
		return $this->sqlMaker->make($query, "fetchAll");
	}

	/*
	** INSERTING
	*/

	public function addExercise($exercise, $trainingId) {
		$query = $this->queryRouter('insertExercise');
		$params = [$trainingId];
		foreach ($exercise as $exoData) {
			array_push($params, $exoData);
		}
		$this->sqlMaker->make($query, NULL, $params);
	}

	public function addExercises($exercises, $trainingId) {
		foreach ($exercises as $exo) {
			$this->addExercise($exo, $trainingId);
		}
	}

	public function addTraining($userId, $training) {
		$query = "INSERT INTO training (id_user, date, shape) VALUES (?, ?, ?)";
		$params = [$userId, $training['trainingMeta']['date'], $training['trainingMeta']['shape']];
		$this->sqlMaker->make($query, NULL, $params);
		$trainingId = $this->sqlMaker->getLastId();
		$this->addExercises($training['exos'], $trainingId);
	}

	/*
	** UPDATING
	*/

	public function updateTraining($trainingId, $training) {
		$this->deleteAllExercises($trainingId);
		$this->addExercises($training['exos'], $trainingId);
		$query = "UPDATE training
		SET date = ?,
		shape = ?
		WHERE id=?";
		$params = [$training['trainingMeta']['date'], $training['trainingMeta']['shape'], $trainingId];
		$this->sqlMaker->make($query, NULL, $params);
	}

	/*
	** DELETING
	*/

	public function deleteAllExercises($trainingId) {
		$query = "DELETE FROM exercise_practice WHERE id_training=?";
		$this->sqlMaker->make($query, NULL, [$trainingId]);
	}

	public function deleteTraining($trainingId) {
		$query = "DELETE FROM training WHERE id=?";
		$this->sqlMaker->make($query, NULL, [$trainingId]);
	}

	public function queryRouter($queryTag) {
		switch ($queryTag) {
			case 'makeTraining':
				$query = "SELECT training.id, training.date, training.shape, exercise_catalog.name AS exoName, exercise_practice.work_load ,exercise_practice.rest, exercise_practice.nb_sets, exercise_practice.nb_reps, method.name AS methodName
				FROM `user`
				LEFT JOIN training ON training.id_user = user.id
				LEFT JOIN exercise_practice ON training.id = exercise_practice.id_training
				LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id
				LEFT JOIN method ON exercise_practice.method_id = method.id
				WHERE training.id=?";
				break;
			case 'insertExercise':
				$query = "INSERT INTO exercise_practice (id_training, id_exercise_catalog, work_load, rest, nb_sets, nb_reps, method_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
				break;
			case 'selectTrainingIds':
					$query = 'SELECT DISTINCT(training.id) AS id_trainings, training.date FROM `user` LEFT JOIN training ON training.id_user = user.id WHERE training.id_user=?
						ORDER BY training.date DESC';
					break;
		}
		return $query;
	}
}