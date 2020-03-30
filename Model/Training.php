<?php
namespace Model;

class Training {
	private $date;
	private $shape;
	private $exercices;
	private $id;

	function __construct($exercices, $date=NULL, $shape=NULL, $id=NULL) {
		$this->exercices = $exercices;
		$this->date = $date;
		$this->shape = $shape;
		$this->id = $id;
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

	public function getId() {
		return $this->id;
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