<?php
namespace Model\Repository;

require_once ('../public/Utils/SqlMaker.php');
use Utils\SqlMaker;

abstract class Repository {
	protected $sqlMaker;

	function __construct() {
		$this->sqlMaker = new SqlMaker();
	}
}