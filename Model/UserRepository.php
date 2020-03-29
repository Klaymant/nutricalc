<?php
namespace Model;

require_once ('Utils/DbConnection.php');
require_once ('Utils/SqlMaker.php');
require_once ('Model/User.php');
use Utils\DbConnection;
use Utils\SqlMaker;
use Model\User;

class UserRepository {
	public function getUserByMail($mail) {
		$query = 'SELECT id, pwd FROM user WHERE mail=?';
		$sqlMaker = new SqlMaker($query, 'fetch', [$mail]);
		return $sqlMaker->make();
	}

	public function getUserById($id) {
		$query = 'SELECT * FROM user LEFT JOIN activity ON user.id_activity = activity.id LEFT JOIN goal ON user.id_goal = goal.id WHERE user.id=?';
		$sqlMaker = new SqlMaker($query, 'fetch', [$id]);
		$user = $sqlMaker->make();
		return new User($user['sex'], $user['age'], $user['height'], $user['weight'], $user['activity_name'], $user['goal_name'], $id, $user['mail'], $user['pwd']);
	}

	public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activity, $goal) {
		$query = 'INSERT INTO user (height, weight, activity, goal, age) VALUES ("?", "?", "?", "?", "?")';
		$sqlMaker = new SqlMaker($query, NULL, [$height, $weight, $activity, $goal, $age]);
		return $sqlMaker->make();
	}

	public function saveData($data) {
		$query = "UPDATE user SET age=?, height=?, weight=?, id_activity=?, id_goal=? WHERE id=?";
		$sqlMaker = new SqlMaker($query, NULL, [$data['age'], $data['height'], $data['weight'], $data['activity'], $data['goal'], $_SESSION['id']]);
		return $sqlMaker->make();
	}

	public function createAccount($data) {
		$query = "INSERT INTO user (mail, pwd) VALUES (?, ?)";
		$sqlMaker = new SqlMaker($query, NULL, [$data['mail'], $data['pwd']]);
		return $sqlMaker->make();
	}

	public function mailExists($mail) {
		$query = "SELECT COUNT(*) as c FROM user WHERE mail=?";
		$sqlMaker = new SqlMaker($query, 'fetch', [$mail]);
		$mailExists = $this->make();
		return $mailExists['c'] == 1 ? true : false;
	}
}