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

	public function getUserByMail($mail) {
		$query = 'SELECT id, pwd FROM user WHERE mail="' . $mail . '"';
		$executed = $this->pdo->prepare($query);
		$executed->execute();
		$user = $executed->fetch(\PDO::FETCH_ASSOC);
		return $user;
	}

	public function getUserById($id) {
		$query = 'SELECT * FROM user AS u
		LEFT JOIN activity AS a
		ON u.id_activity = a.id
		LEFT JOIN goal AS g
		ON u.id_goal = g.id
		WHERE u.id=' . $id;
		$executed = $this->pdo->prepare($query);
		$executed->execute();
		$user = $executed->fetch(\PDO::FETCH_ASSOC);

		return new User($user['sex'], $user['age'], $user['height'], $user['weight'], $user['activity_name'], $user['goal_name'], $id, $user['mail'], $user['pwd']);
	}

	public function getTrainingsById($userId) {
		// First of all we get the trainings ids of a user by his user id
		$trainingsIdQuery = 'SELECT DISTINCT(training.id) AS id_trainings FROM `user`
		LEFT JOIN user_training ON user_training.id_user = user.id
        LEFT JOIN training ON training.id = user_training.id_training
		LEFT JOIN exercise_practice ON user_training.id_training = exercise_practice.id_training
		LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id
		WHERE user_training.id_user=?
		ORDER BY training.id DESC';
		$executed = $this->pdo->prepare($trainingsIdQuery);
		$executed->execute([$userId]);
		$trainingsIds = $executed->fetchAll(\PDO::FETCH_ASSOC);

		$myTrainings = [];

		// For each training we get for a user all the exercises and put them into an array that is pushed itself in an another array containing all of the trainings
		foreach ($trainingsIds as $tId) {
			$query = 'SELECT training.id, training.date, training.shape, exercise_catalog.name AS name, exercise_practice.rest, exercise_practice.nb_sets, exercise_practice.nb_reps, exercise_practice.method FROM `user`
			LEFT JOIN user_training ON user_training.id_user = user.id
	        LEFT JOIN training ON training.id = user_training.id_training
			LEFT JOIN exercise_practice ON user_training.id_training = exercise_practice.id_training
			LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id
			WHERE training.id=? AND user_training.id_user=?';
			$executed = $this->pdo->prepare($query);
			$executed->execute([$tId['id_trainings'], $userId]);
			$trainings = $executed->fetchAll(\PDO::FETCH_ASSOC);

			$exercises = [];
			foreach ($trainings AS $train) {
				array_push($exercises, new Exercise($train['name'], $train['rest'], $train['nb_sets'], $train['nb_reps'], $train['method']));
			}
			array_push($myTrainings, new Training($exercises, $train['date'], $train['shape']));
		}
		return $myTrainings;
	}

	public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activity, $goal) {
		$query = 'INSERT INTO user (height, weight, activity, goal, age)
		VALUES ("{$height}", "{$weight}", "{$activity}", "{$goal}", "{$age}")';
		$createdUser = $this->pdo->prepare();
		
		return $createdUser->executed;
	}

	public function saveData($data) {
		$query = "UPDATE user
			SET 
			age=?,
			height=?,
			weight=?,
			id_activity=?,
			id_goal=?
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