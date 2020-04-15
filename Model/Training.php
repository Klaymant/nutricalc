<?php
namespace Model;

class Training {
	private $date;
	private $shape;
	private $exercises;
	private $id;

	function __construct($exercises, $date=NULL, $shape=NULL, $id=NULL) {
		$this->exercises = $exercises;
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
		return $this->exercises;
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