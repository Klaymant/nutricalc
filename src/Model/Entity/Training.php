<?php
namespace Model\Entity;

require_once('../src/Model/Entity/Entity.php');
use Model\Entity\Entity;

class Training extends Entity {
	protected $date;
	protected $shape;
	protected $exercises;
	protected $id;

	function __construct($exercises, $date=NULL, $shape=NULL, $id=NULL) {
		$this->exercises = $exercises;
		$this->date = $date;
		$this->shape = $shape;
		$this->id = $id;
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