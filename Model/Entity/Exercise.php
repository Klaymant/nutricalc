<?php
namespace Model\Entity;

class Exercise {
	private $name;
	private $workLoad;
	private $rest;
	private $nbSets;
	private $nbReps;
	private $method;

	function __construct($name, $workLoad, $rest, $sets, $reps, $method=NULL) {
		$this->name = $name;
		$this->workLoad = $workLoad;
		$this->rest = $rest;
		$this->nbSets = $sets;
		$this->nbReps = $reps;
		$this->method = $method;
	}

	// Getters
	public function getName() {
		return $this->name;
	}

	public function getWorkLoad() {
		return $this->workLoad;
	}

	public function getRest() {
		return $this->rest;
	}

	public function getSets() {
		return $this->nbSets;
	}

	public function getReps() {
		return $this->nbReps;
	}

	public function getMethod() {
		return $this->method;
	}

	// Setters
	public function setName($name) {
		$this->name = $name;
	}

	public function setWorkLoad($workLoad) {
		$this->workLoad = $workLoad;
	}

	public function setRest($rest) {
		$this->rest = $rest;
	}

	public function setSets($nbSets) {
		$this->nbSets = $nbSets;
	}

	public function setReps($nbReps) {
		$this->nbReps = $nbReps;
	}

	public function setMethod($method) {
		$this->method = $method;
	}

	public function jsonSerialize($fields=NULL)
    {
    	$vars = array();
    	if ($fields == NULL) {
        	$vars = get_object_vars($this);
        }
        else {
        	foreach ($fields as $elem) {
        		if (property_exists($this, $elem)) {
        			array_push($vars, array($elem, $this->$elem));
        		}
        	}
        }
        return $vars;
    }
}