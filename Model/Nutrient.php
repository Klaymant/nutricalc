<?php
namespace Model;

class Nutrient {
	private $kcal;
	private $protein;
	private $fat;
	private $carb;

	function __construct($id, $kcal, $protein, $fat, $carb)
	{
		$this->id = $id;
		$this->kcal = $kcal;
		$this->protein = $protein;
		$this->fat = $fat;
		$this->carb = $carb;
	}

	// Getters
	public function getId() {
		return $this->id;
	}

	public function getKcal() {
		return $this->kcal;
	}

	public function getProtein() {
		return $this->protein;
	}

	public function getFat() {
		return $this->fat;
	}

	public function getCarb() {
		return $this->carb;
	}

	// Setters
	public function setKcal($kcal) {
		$this->kcal = $kcal;
	}

	public function setProtein($protein) {
		$this->protein = $protein;
	}

	public function setFat($fat) {
		$this->fat = $fat;
	}

	public function setCarb($carb) {
		$this->carb = $carb;
	}
}