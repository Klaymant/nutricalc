<?php
namespace Model\Entity;

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
	public function getAttribute($attributeName) {
		return $this->{$attributeName};
	}

	// Setters
	public function setAttribute($attributeName, $value) {
		$this->{$attributeName} = $value;
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