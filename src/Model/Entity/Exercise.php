<?php
namespace Model\Entity;

require_once('../src/Model/Entity/Entity.php');
use Model\Entity\Entity;

class Exercise extends Entity {
	protected $name;
	protected $workLoad;
	protected $rest;
	protected $nbSets;
	protected $nbReps;
	protected $method;

	function __construct($name, $workLoad, $rest, $sets, $reps, $method=NULL) {
		$this->name = $name;
		$this->workLoad = $workLoad;
		$this->rest = $rest;
		$this->nbSets = $sets;
		$this->nbReps = $reps;
		$this->method = $method;
	}
}