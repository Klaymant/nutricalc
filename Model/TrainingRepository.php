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

	// Get the training ids of a user by his id
	public function getTrainingsIds($userId) {
		$trainingsIdQuery = 'SELECT DISTINCT(training.id) AS id_trainings FROM `user` LEFT JOIN training ON training.id_user = user.id WHERE training.id_user=?
		ORDER BY training.id DESC';
		$sqlMaker = new SqlMaker($trainingsIdQuery, 'fetchAll', [$userId]);
		return $sqlMaker->make();
	}

	// Create a Training thanks to the training id by a user id
	public function makeTrainingById($trainingId, $userId) {
		$query = 'SELECT training.id, training.date, training.shape, exercise_catalog.name, exercise_practice.rest, exercise_practice.nb_sets, exercise_practice.nb_reps, exercise_practice.method FROM `user` LEFT JOIN training ON training.id_user = user.id LEFT JOIN exercise_practice ON training.id = exercise_practice.id_training LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id WHERE training.id=? AND training.id_user=?';
		$sqlMaker = new SqlMaker($query, 'fetchAll', [$trainingId, $userId]);
		$training = $sqlMaker->make();

		$exercises = [];
		foreach ($training AS $exo) {
			array_push($exercises, new Exercise($exo['name'], $exo['rest'], $exo['nb_sets'], $exo['nb_reps'], $exo['method']));
		}
		return new Training($exercises, $training[0]['date'], $training[0]['shape'], $training[0]['id']);
	}

	// Get the $nbTrainings last trainings
	public function getLastTrainings($userId, $nbTrainings=NULL) {
		$trainingIds = $this->getTrainingsIds($userId, $nbTrainings);
		return $nbTrainings != NULL ? array_slice($trainingIds, 0, $nbTrainings) : $trainingIds;
	}

	// Create the $nbTrainings last trainings
	public function makeLastTrainings($userId, $nbTrainings=NULL) {
		$trainingIds = $this->getLastTrainings($userId, $nbTrainings);
		$trainings = [];

		foreach ($trainingIds AS $trainingId) {
            array_push($trainings, $this->makeTrainingById($trainingId['id_trainings'], $userId));
        }
        return $trainings;
	}

	// Create a list of users' trainings by his id
	public function getAllTrainingsById($userId) {
		$trainingIds = $this->getTrainingsIds($userId);
		$myTrainings = [];
		foreach ($trainingIds as $trainingId) {
			$training = $this->makeTrainingById($trainingId, $userId);
			array_push($myTrainings, $training);
		}
		return $myTrainings;
	}
}