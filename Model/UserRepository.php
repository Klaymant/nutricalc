<?php
namespace Model;

require_once ('Utils/DbConnection.php');
require_once ('Model/User.php');
use Utils\DbConnection;
use Model\User;

class UserRepository {
	private $pdo;

	function __construct () {
		$dbc = new DbConnection();
		$this->pdo = $dbc->getPdo();
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

		return new User($id, $user['sex'], $user['age'], $user['height'], $user['weight'], $user['activity_name'], $user['goal_name']);
	}

	public function createUser($sex, $age, $height, $weight, $activity, $goal) {
		$query = 'INSERT INTO user (height, weight, activity, goal, age)
			VALUES ("{$height}", "{$weight}", "{$activity}", "{$goal}", "{$age}")';
		$createUser = $this->pdo->prepare();
		return $createUser->execute;
	}
}