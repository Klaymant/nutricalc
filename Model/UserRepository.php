<?php
namespace Model;

require_once ('Utils/DbConnection.php');
require_once ('Model/User.php');
require_once ('Model/Training.php');
require_once ('Model/Exercise.php');
use Utils\DbConnection;
use Model\User;
use Model\Training;
use Model\Exercise;

class UserRepository {
	private $pdo;

	function __construct () {
		$dbc = new DbConnection();
		$this->pdo = $dbc->getPdo();
	}

	public function makeSqlQuery($query, $params=NULL, $all=true, $fetchType=\PDO::FETCH_ASSOC) {
		$executed = $this->pdo->prepare($query);
		$executed->execute($params);
		return $all ? $executed->fetchAll($fetchType) : $executed->fetch($fetchType);
	}

	public function getUserByMail($mail) {
		$query = 'SELECT id, pwd FROM user WHERE mail=?';
		return $this->makeSqlQuery($query, [$mail], false);
	}

	public function getUserById($id) {
		$query = 'SELECT * FROM user
		LEFT JOIN activity ON user.id_activity = activity.id
		LEFT JOIN goal ON user.id_goal = goal.id
		WHERE user.id=?';
		$user = $this->makeSqlQuery($query, [$id], false);

		return new User($user['sex'], $user['age'], $user['height'], $user['weight'], $user['activity_name'], $user['goal_name'], $id, $user['mail'], $user['pwd']);
	}

	// Get the training ids of a user by his id
	public function getTrainingsIds($userId) {
		$trainingsIdQuery = 'SELECT DISTINCT(training.id) AS id_trainings FROM `user`
        LEFT JOIN training ON training.id_user = user.id
		WHERE training.id_user=?
		ORDER BY training.id DESC';
		return $this->makeSqlQuery($trainingsIdQuery, [$userId]);
	}

	// Create a Training thanks to the training_id by a user id
	public function makeTrainingById($trainingId, $userId) {
		$query = 'SELECT training.date, training.shape, exercise_catalog.name, exercise_practice.rest, exercise_practice.nb_sets, exercise_practice.nb_reps, exercise_practice.method FROM `user`
        LEFT JOIN training ON training.id_user = user.id
		LEFT JOIN exercise_practice ON training.id = exercise_practice.id_training
		LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id
		WHERE training.id=? AND training.id_user=?';
		$training = $this->makeSqlQuery($query, [$trainingId['id_trainings'], $userId]);

		$exercises = [];
		foreach ($training AS $exo) {
			array_push($exercises, new Exercise($exo['name'], $exo['rest'], $exo['nb_sets'], $exo['nb_reps'], $exo['method']));
		}
		return ['exercises' => $exercises, 'date' => $training[0]['date'], 'shape' => $training[0]['shape']];
	}

	// Create a list of users' trainings by his id
	public function getAllTrainingsById($userId) {
		$trainingsIds = $this->getTrainingsIds($userId);

		$myTrainings = [];
		foreach ($trainingsIds as $trainingId) {
			$training = $this->makeTrainingById($trainingId, $userId);
			array_push($myTrainings, new Training($training['exercises'], $training['date'], $training['shape']));
		}
		return $myTrainings;
	}

	public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activity, $goal) {
		$query = 'INSERT INTO user (height, weight, activity, goal, age)
		VALUES ("?", "?", "?", "?", "?")';
		$createdUser = $this->pdo->prepare();
		
		return $createdUser->execute([$height, $weight, $activity, $goal, $age]);
	}

	public function saveData($data) {
		$query = "UPDATE user
			SET age=?, height=?, weight=?, id_activity=?, id_goal=?
			WHERE id=?";
		$executed = $this->pdo->prepare($query);
    	return $executed->execute([$data['age'], $data['height'], $data['weight'], $data['activity'], $data['goal'], $_SESSION['id']]);
	}

	public function createAccount($data) {
		$query = "INSERT INTO user (mail, pwd) VALUES (?, ?)";
		$executed = $this->pdo->prepare($query);
		return $executed->execute([$data['mail'], $data['pwd']]);
	}

	public function mailExists($mail) {
		$query = "SELECT COUNT(*) as c FROM user WHERE mail=?";
		$executed = $this->pdo->prepare($query);
		$executed->execute([$mail]);
		$mailExists = $executed->fetch(\PDO::FETCH_ASSOC);
		return $mailExists['c'] == 1 ? true : false;
	}
}