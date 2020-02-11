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

	public function setNutrient($kcal, $proteins, $fat, $carbs) {
		$this->nutrient->setKcalNeeds($kcal);
		$this->nutrient->setProteins($proteins);
		$this->nutrient->setFat($fat);
		$this->nutrient->setCarbs($carbs);
	}

	public function setBmr($bmr) {
		$this->bmr = $bmr;
	}

	public function setKcalNeeds($kcalNeeds) {
		$this->kcalNeeds = $kcalNeeds;
	}
}