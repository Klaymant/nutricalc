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

	public function getTrainingsIds($userId) {
		$trainingsIdQuery = 'SELECT DISTINCT(training.id) AS id_trainings FROM `user`
        LEFT JOIN training ON training.id_user = user.id
		WHERE training.id_user=?
		ORDER BY training.id DESC';
		$executed = $this->pdo->prepare($trainingsIdQuery);
		$executed->execute([$userId]);
		return $executed->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function makeTraining($tId, $userId) {
			$query = 'SELECT training.date, training.shape, exercise_catalog.name, exercise_practice.rest, exercise_practice.nb_sets, exercise_practice.nb_reps, exercise_practice.method FROM `user`
	        LEFT JOIN training ON training.id_user = user.id
			LEFT JOIN exercise_practice ON training.id = exercise_practice.id_training
			LEFT JOIN exercise_catalog ON exercise_practice.id_exercise_catalog = exercise_catalog.id
			WHERE training.id=? AND training.id_user=?';
			$executed = $this->pdo->prepare($query);
			$executed->execute([$tId['id_trainings'], $userId]);
			$trainings = $executed->fetchAll(\PDO::FETCH_ASSOC);

			$exercises = [];
			foreach ($trainings AS $exo) {
				array_push($exercises, new Exercise($exo['name'], $exo['rest'], $exo['nb_sets'], $exo['nb_reps'], $exo['method']));
			}
			return [$exercises, $trainings[0]['date'], $trainings[0]['shape']];
	}

	public function getAllTrainingsById($userId) {
		$trainingsIds = $this->getTrainingsIds($userId);

		$myTrainings = [];
		foreach ($trainingsIds as $tId) {
			$training = $this->makeTraining($tId, $userId);
			array_push($myTrainings, new Training($training[0], $training[1], $training[2]));
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