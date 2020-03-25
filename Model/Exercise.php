<?php

namespace Model;

class Exercise {
	private $name;
	private $rest;
	private $nbSets;
	private $nbReps;
	private $method;

	function __construct($name, $rest, $nbSets, $nbReps, $method=NULL) {
		$this->name = $name;
		$this->rest = $rest;
		$this->nbSets = $nbSets;
		$this->nbReps = $nbReps;
		$this->method = $method;
	}

	// Getters
	public function getName() {
		return $this->name;
	}

	public function getRest() {
		return $this->rest;
	}

	public function getNbSets() {
		return $this->nbSets;
	}

	public function getNbReps() {
		return $this->$nbReps;
	}

	public function getMethod() {
		return $this->method;
	}

	// Setters
	public function setName($name) {
		$this->name = $name;
	}

	public function setRest($rest) {
		$this->rest = $rest;
	}

	public function setNbSets($nbSets) {
		$this->nbSets = $nbSets;
	}

	public function setReps($nbReps) {
		$this->nbReps = $nbReps;
	}

	public function setMethod($method) {
		$this->method = $method;
	}
}