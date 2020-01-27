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
		$query = $this->pdo->prepare('SELECT * FROM user WHERE id={$id}');
		$query->execute;
		$query->fetchAll(\PDO::FETCH_ASSOC);

		return new User($id, $query['height'], $query['weight'], $query['activity'], $query['goal'], $query['bmr'], $query['nutrient']);
	}
}