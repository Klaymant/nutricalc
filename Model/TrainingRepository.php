<?php
namespace Model;

require_once ('Utils/DbConnection.php');
require_once ('Utils/SqlMaker.php');
require_once ('Model/User.php');
require_once ('Model/Training.php');
require_once ('Model/Exercise.php');
use Utils\DbConnection;
use Utils\SqlMaker;
use Model\User;
use Model\Training;
use Model\Exercise;

class TrainingRepository {

	private $sqlMaker;

	function __construct() {
		$this->sqlMaker = new SqlMaker();
	}

	public function getTrainingsIds($userId) {
		$trainingsIdQuery = 'SELECT DISTINCT(training.id) AS id_trainings, training.date FROM `user` LEFT JOIN training ON training.id_user = user.id WHERE training.id_user=?
		ORDER BY training.date DESC';
		return $this->sqlMaker->make($trainingsIdQuery, 'fetchAll', [$userId]);
	}

	public function makeTrainingById($trainingId, $userId) {
		$query = 'SELECT training.id, training.date, training.shape, exercise_catalog.name, exercise_practice.work_load ,exercise_practice.rest, exercise_practice.nb_sets, exercise_practice.nb_reps, exercise_practice.method FROM `user` LEFT JOIN training ON training.id_user = user.id LEFT JOIN exercise_practice ON training.id = exercise_practice.id_training LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id WHERE training.id=? AND training.id_user=?';
		$training = $this->sqlMaker->make($query, 'fetchAll', [$trainingId, $userId]);

		$exercises = [];
		foreach ($training AS $exo) {
			array_push($exercises, new Exercise($exo['name'], $exo['work_load'], $exo['rest'], $exo['nb_sets'], $exo['nb_reps'], $exo['method']));
		}
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
            array_push($trainings, $this->makeTrainingById($trainingId['id_trainings'], $userId));
        }
        return $trainings;
	}

	public function getAllTrainingsById($userId) {
		$trainingIds = $this->getTrainingsIds($userId);
		$myTrainings = [];
		foreach ($trainingIds as $trainingId) {
			$training = $this->makeTrainingById($trainingId['id_trainings'], $userId);
			array_push($myTrainings, $training);
		}
		return $myTrainings;
	}

	public function getAllExercisesInfo() {
		$query = "SELECT id, name FROM `exercise_catalog`";
		return $this->sqlMaker->make($query, "fetchAll");
	}

	public function saveExercise($exercise, $trainingId) {
		$query = "INSERT INTO exercise_practice (id_training, id_exercise_catalog, work_load, rest, nb_sets, nb_reps, method) VALUES (?, ?, ?, ?, ?, ?, ?)";
		
		$params = [$trainingId];
		foreach ($exercise as $exoData) {
			array_push($params, $exoData);
		}
		$this->sqlMaker->make($query, NULL, $params);
	}

	public function saveTraining($trainingInfo, $userId, $exercises) {
		$query = "INSERT INTO training (id_user, date, shape) VALUES (?, ?, ?)";
		$params = [$userId, $trainingInfo['date'], $trainingInfo['shape']];
		$this->sqlMaker->make($query, NULL, $params);
		$trainingId = $this->sqlMaker->getLastId();

		foreach ($exercises as $exo) {
			$this->saveExercise($exo, $trainingId);
		}
	}

	public function deleteTraining($trainingId) {
		$query = "DELETE from training WHERE id=?";
		$this->sqlMaker->make($query, NULL, [$trainingId]);
	}

	public function editTraining($trainingId, $trainingInfo, $exercises) {

	}
}