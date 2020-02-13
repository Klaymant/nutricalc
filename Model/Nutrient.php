<?php
namespace Model;

class Nutrient {
	private $kcal;
	private $proteins;
	private $fat;
	private $carbs;

	function __construct($kcal, $proteins, $fat, $carbs)
	{
		$this->kcal = $kcal;
		$this->proteins = $proteins;
		$this->fat = $fat;
		$this->carbs = $carbs;
	}

	// Getters
	public function getKcalNeeds() {
		return $this->kcal;
	}

	public function getProteins() {
		return $this->proteins;
	}

	public function getFat() {
		return $this->fat;
	}

	public function getCarbs() {
		return $this->carbs;
	}

	// Setters
	public function setKcalNeeds($kcal) {
		$this->kcal = $kcal;
	}

	public function setProteins($proteins) {
		$this->proteins = $proteins;
	}

	public function setFat($fat) {
		$this->fat = $fat;
	}

	public function setCarbs($carbs) {
		$this->carbs = $carbs;
	}
}