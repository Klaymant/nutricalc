<?php
namespace Model;

require_once ('Utils/SqlMaker.php');
use Utils\SqlMaker;

class Repository {
	protected $sqlMaker;

	function __construct() {
		$this->sqlMaker = new SqlMaker();
	}
}