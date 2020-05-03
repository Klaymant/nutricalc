<?php
namespace Utils;

require_once ('../public/Utils/DbConnection.php');
use Utils\DbConnection;

class SqlMaker {
	private $pdo;
	private $lastId;

	function __construct () {
		$dbc = new DbConnection();
		$this->pdo = $dbc->getPdo();
	}

	public function getLastId() {
		return $this->lastId;
	}

	public function make($query, $command=NULL, $params=NULL, $fetchType=\PDO::FETCH_ASSOC) {
		$executed = $this->pdo->prepare($query);
		$executed->execute($params);
		$this->lastId = $this->pdo->lastInsertId();
		if ($command != NULL) {
			return $executed->$command($fetchType);
		}
	}
}