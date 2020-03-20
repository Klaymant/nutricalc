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

	public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activity, $goal) {
		$query = 'INSERT INTO user (height, weight, activity, goal, age)
			VALUES ("{$height}", "{$weight}", "{$activity}", "{$goal}", "{$age}")';
		$createUser = $this->pdo->prepare();
		return $createUser->execute;
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