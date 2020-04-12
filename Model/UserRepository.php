<?php
namespace Model;

require_once ('Model/Repository.php');
require_once ('Model/User.php');
use Model\Repository;
use Model\User;

class UserRepository extends Repository {

	public function getUserByMail($mail) {
		$query = 'SELECT id, pwd FROM user WHERE mail=?';
		return $this->sqlMaker->make($query, 'fetch', [$mail]);
	}

	public function getUserById($id) {
		$query = 'SELECT * FROM user LEFT JOIN activity ON user.id_activity = activity.id LEFT JOIN goal ON user.id_goal = goal.id WHERE user.id=?';
		$user = $this->sqlMaker->make($query, 'fetch', [$id]);
		return new User($user['sex'], $user['age'], $user['height'], $user['weight'], $user['activity_name'], $user['goal_name'], $id, $user['mail'], $user['pwd']);
	}

	public function getMailById($userId) {
		$query = "SELECT mail FROM user WHERE id=?";
		return $this->sqlMaker->make($query, 'fetch', [$userId]);
	}

	public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activity, $goal) {
		$query = 'INSERT INTO user (height, weight, activity, goal, age) VALUES ("?", "?", "?", "?", "?")';
		return $this->sqlMaker->make($query, NULL, [$height, $weight, $activity, $goal, $age]);
	}

	public function saveData($data) {
		$query = "UPDATE user SET age=?, height=?, weight=?, id_activity=?, id_goal=? WHERE id=?";
		return $this->sqlMaker->make($query, NULL, [$data['age'], $data['height'], $data['weight'], $data['activity'], $data['goal'], $_SESSION['id']]);
	}

	public function createAccount($data) {
		$query = "INSERT INTO user (mail, pwd) VALUES (?, ?)";
		return $this->sqlMaker->make($query, NULL, [$data['mail'], $data['pwd']]);
	}

	public function mailExists($mail) {
		$query = "SELECT COUNT(*) as c FROM user WHERE mail=?";
		$mailExists = $this->sqlMaker->make($query, 'fetch', [$mail]);
		return $mailExists['c'] == 1 ? true : false;
	}
}