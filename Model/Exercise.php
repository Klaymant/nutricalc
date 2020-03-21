<?php

namespace Model;

class Exercise {
	private $name;
	private $description;
	private $bodyparts;
	private $polyarticular;

	function __construct($name, $description, $bodyparts, $polyarticular) {
		$this->name = $name;
		$this->description = $description;
		$this->bodyparts = $bodyparts;
		$this->polyarticular = $polyarticular;
	}

	// Getters
	public function getName() {
		return $this->name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getBodyparts() {
		return $this->bodyparts;
	}

	public function getPolyarticular() {
		return $this->polyarticular;
	}
}