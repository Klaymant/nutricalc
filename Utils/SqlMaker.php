<?php
namespace Utils;

require_once ('Utils/DbConnection.php');
use Utils\DbConnection;

class SqlMaker {
	private $pdo;
	private $query;
	private $command;
	private $params;
	private $fetchType;

	function __construct ($query, $command='fetch', $params=NULL, $fetchType=\PDO::FETCH_ASSOC) {
		$dbc = new DbConnection();
		$this->pdo = $dbc->getPdo();
		$this->query = $query;
		$this->command = $command;
		$this->params = $params;
		$this->fetchType = $fetchType;
	}

	public function make() {
		$executed = $this->pdo->prepare($this->query);
		$executed->execute($this->params);
		switch ($this->command) {
			case 'fetch':
				return $executed->fetch($this->fetchType);
				break;
			case 'fetchAll':
				return $executed->fetchAll($this->fetchType);
				break;
			default:
				break;
		}
	}
}