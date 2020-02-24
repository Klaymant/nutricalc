<?php
namespace Model;

require_once('Model/Nutrient.php');
use Model\Nutrient;

class User {
	private $sex;
	private $age;
	private $height;
	private $weight;
	private $activity;
	private $goal;
	private $bmr;
	private $nutrient;
	private $trainings;

	function __construct($id, $mail, $pwd, $sex, $age, $height, $weight, $activity, $goal)
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
	}

	// Getters
	public function getId() {
		return $this->id;
	}

	public function getMail() {
		return $this->mail;
	}

	public function getPwd() {
		return $this->pwd;
	}


	public function getAge() {
		return $this->age;
	}

	public function getSex() {
		return $this->sex;
	}

	public function getHeight() {
		return $this->height;
	}

	public function getWeight() {
		return $this->weight;
	}

	public function getActivity() {
		return $this->activity;
	}

	public function getGoal() {
		return $this->goal;
	}

	public function getBmr() {
		return $this->bmr;
	}

	public function getNutrient() {
		return $this->nutrient;
	}

	public function getKcalNeeds() {
		return $this->kcalNeeds;
	}

	// Setters
	public function setAge($age) {
		$this->age = $age;
	}

	public function setMail($mail) {
		$this->mail = $mail;
	}

	public function setPwd($pwd) {
		$this->pwd = $pwd;
	}

	public function setSex($sex) {
		$this->sex = $sex;
	}

	public function setHeight($height) {
		$this->height = $height;
	}

	public function setWeight($weight) {
		$this->weight = $weight;
	}

	public function setActivity($activity) {
		$this->activity = $activity;
	}

	public function setGoal($goal) {
		$this->goal = $goal;
	}

	public function setBmr($bmr) {
		$this->bmr = $bmr;
	}

	public function setKcalNeeds($kcalNeeds) {
		$this->kcalNeeds = $kcalNeeds;
	}

    public function calculateBmr() {
    	$menFormula = ($this->weight*13.707) + ($this->height/100*492.2) - ($this->age*6.673) + 77.607;
    	$womenFormula = ($this->weight*9.74) + ($this->height/100*172.9) - ($this->age*4.737) + 667.05;
    	
    	return $this->sex == 'H' ? $menFormula : $womenFormula;
    }

	// Calculate the kcal needs depending on the activity quotient, BMR and the wanted goal
    public function kcalNeeds() {
    	switch ($this->goal) {
    		case "Fat loss":
    			return ($this->bmr*$this->activityQuotient($this->activity)*0.8);
    		case "Maintain":
    			return ($this->bmr*$this->activityQuotient($this->activity*1));
    		case "Mass gain":
    			return ($this->bmr*$this->activityQuotient($this->activity*1.2));
    	}
    }

    public function proteinsNeeds() {
        switch ($this->goal) {
            case "Fat loss":
                return ($this->weight*1.4);
            case "Maintain":
                return ($this->weight*1.5);
            case "Mass gain":
                return ($this->weight*1.6);
        }
    }

    public function fatNeeds() {
        switch ($this->goal) {
            case "Fat loss":
                return ($this->weight*1.2);
            case "Maintain":
                return ($this->weight*1);
            case "Mass gain":
                return ($this->weight*0.8);
        }
    }

    public function carbsNeeds() {
        return ($this->nutrient->getKcalNeeds()-($this->nutrient->getProteinsNeeds()*4)-($this->nutrient->getFatNeeds()*9))/4;
    }

    private function activityQuotient() {
    	switch ($this->activity) {
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
    	}
    }

    public function calcAllNeeds() {
    	$this->bmr = $this->calculateBmr();
        $this->nutrient->setKcalNeeds($this->kcalNeeds());
        $this->nutrient->setProteinsNeeds($this->proteinsNeeds());
        $this->nutrient->setFatNeeds($this->fatNeeds());
        $this->nutrient->setCarbsNeeds($this->carbsNeeds());
    }
}