<?php
namespace Model;

require_once ('Utils/DbConnection.php');
require_once ('Model/Nutrient.php');
use Utils\DbConnection;
use Model\Nutrient;

class NutrientRepository {
	private $pdo;

	function __construct () {
		$dbc = new DbConnection();
		$this->pdo = $dbc->getPdo();
	}
}