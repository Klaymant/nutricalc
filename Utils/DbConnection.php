<?php
namespace Utils;

require_once ('Config/DbInfo.php');
use Config\DbInfo;
use \PDO;

class DbConnection {
	private $pdo;

	function __construct()
	{
		$this->pdo = new PDO(
	        'mysql:host=' . DbInfo::HOST . ';dbname=' . DbInfo::DB_NAME . ';',
	        DbInfo::USERNAME,
	        DbInfo::PWD,
	        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}

	public function getPdo()
	{
		return $this->pdo;
	}
}