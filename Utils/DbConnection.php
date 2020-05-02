<?php
namespace Utils;

require("../Utils/YamlHelper.php");

use Utils\YamlHelper;
use \PDO;

class DbConnection {
	private $pdo;

	function __construct()
	{
		$yamlHelper = new YamlHelper('dbinfo.yaml');
        $dbInfo = $yamlHelper->getPaths();
		$this->pdo = new PDO(
	        'mysql:host=' . $dbInfo['HOST'] . ';dbname=' . $dbInfo['DB_NAME'] . ';',
	        $dbInfo['USERNAME'],
	        $dbInfo['PWD'],
	        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}

	public function getPdo()
	{
		return $this->pdo;
	}
}