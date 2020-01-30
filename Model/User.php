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
	private $kcal_needs;

	function __construct($id, $sex, $age, $height, $weight, $activity, $goal)
	{
		$this->id = $id;
		$this->sex = $sex;
		$this->age = $age;
		$this->height = $height;
		$this->weight = $weight;
		$this->activity = $activity;
		$this->goal = $goal;
	}

	// Getters
	public function getId() {
		return $this->id;
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
	public function setAge($agee) {
		$this->age = $age;
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

	public function setNutrient($nutrient) {
		$this->nutrient = $nutrient;
	}

	public function setBmr($bmr) {
		$this->bmr = $bmr;
	}

	public function setKcalNeeds($kcalNeeds) {
		$this->kcalNeeds = $kcalNeeds;
	}
}