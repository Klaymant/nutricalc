<?php
namespace Model;

require_once ('Utils/SqlMaker.php');
use Utils\SqlMaker;

abstract class Repository {
	protected $sqlMaker;

	function __construct() {
		$this->sqlMaker = new SqlMaker();
	}
}