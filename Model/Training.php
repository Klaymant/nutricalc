<?php
namespace Model;

class Training {
	private $date;
	private $shape;
	private $exercices;

	function __construct($exercices, $date=NULL, $shape=NULL) {
		$this->exercices = $exercices;
		$this->date = $date;
		$this->shape = $shape;
	}

	// Getters
	public function getDate() {
		return $this->date;
	}

	public function getShape() {
		return $this->shape;
	}

	public function getExercises() {
		return $this->exercices;
	}

	// Setters
	public function setDate($date) {
		return $this->date = $date;
	}

	public function setShape($shape) {
		return $this->shape = $shape;
	}

	public function setExercises($exercices) {
		return $this->exercices = $exercices;
	}
}