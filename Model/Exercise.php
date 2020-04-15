<?php

namespace Model;

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
		$this->sets = $sets;
		$this->reps = $reps;
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
		return $this->sets;
	}

	public function getReps() {
		return $this->reps;
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

	public function setSets($sets) {
		$this->sets = $sets;
	}

	public function setReps($reps) {
		$this->reps = $reps;
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