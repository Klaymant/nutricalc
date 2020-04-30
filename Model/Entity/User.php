<?php
namespace Model\Entity;

require_once('Model/Entity/Nutrient.php');
require_once('Model/Entity/Training.php');
use Model\Entity\Nutrient;
use Model\Entity\Training;

class User {
	private $mail;
	private $pwd;
	private $sex;
	private $age;
	private $height;
	private $weight;
	private $activity;
	private $goal;
	private $bmr;
	private $nutrient;
	private $trainings;

	function __construct($sex, $age, $height, $weight, $activity, $goal, $id=NULL, $mail=NULL, $pwd=NULL)
	{
		$this->id = $id;
		$this->mail = $mail;
		$this->pwd = $pwd;
		$this->sex = $sex;
		$this->age = $age;
		$this->height = $height;
		$this->weight = $weight;
		$this->activity = $activity;
		$this->goal = $goal;
		$this->nutrient = new Nutrient(NULL, NULL, NULL, NULL);
		$this->trainings = [];
	}

	public function getAttribute($attributeName) {
		return $this->{$attributeName};
	}

	public function setAttribute($attributeName, $value) {
		$this->{$attributeName} = $value;
	}

    public function calculateBmr() {
    	$menFormula = ($this->weight*13.707) + ($this->height/100*492.2) - ($this->age*6.673) + 77.607;
    	$womenFormula = ($this->weight*9.74) + ($this->height/100*172.9) - ($this->age*4.737) + 667.05;
    	
    	return ($this->sex == 'H') ? $menFormula : $womenFormula;
    }

    public function calcKcalNeeds() {
    	switch ($this->goal) {
    		case "Fat loss":
    			return ($this->bmr*$this->activityQuotient($this->activity)*0.8);
    		case "Maintain":
    			return ($this->bmr*$this->activityQuotient($this->activity)*1);
    		case "Mass gain":
    			return ($this->bmr*$this->activityQuotient($this->activity)*1.2);
    	}
    }

    public function calcProteinsNeeds() {
        switch ($this->goal) {
            case "Fat loss":
                return ($this->weight*1.4);
            case "Maintain":
                return ($this->weight*1.5);
            case "Mass gain":
                return ($this->weight*1.6);
        }
    }

    public function calcFatNeeds() {
        switch ($this->goal) {
            case "Fat loss":
                return ($this->weight*1.2);
            case "Maintain":
                return ($this->weight*1);
            case "Mass gain":
                return ($this->weight*0.8);
        }
    }

    public function calcCarbsNeeds() {
        return ($this->nutrient->getAttribute("kcalNeeds")-($this->nutrient->getAttribute("proteinsNeeds")*4)-($this->nutrient->getAttribute("fatNeeds")*9))/4;
    }

    private function activityQuotient() {
    	switch ($this->activity) :
    		case "Any":
    			return 1;
    		case "Low":
    			return 1.2;
    		case "Moderate":
    			return 1.37;
    		case "High":
    			return 1.5;
    		case "Very high":
    			return 1.8;
    	endswitch;
    }

    public function calcAllNeeds() {
    	$this->bmr = $this->calculateBmr();
        $this->nutrient->setAttribute("kcalNeeds", $this->calcKcalNeeds());
        $this->nutrient->setAttribute("proteinsNeeds", $this->calcProteinsNeeds());
        $this->nutrient->setAttribute("fatNeeds", $this->calcFatNeeds());
        $this->nutrient->setAttribute("carbsNeeds" ,$this->calcCarbsNeeds());
    }
}