<?php
namespace Model;

class Nutrient {
	private $kcalNeeds;
	private $proteinsNeeds;
	private $fatNeeds;
	private $carbsNeeds;

	function __construct($kcalNeeds, $proteinsNeeds, $fatNeeds, $carbsNeeds)
	{
		$this->kcalNeeds = $kcalNeeds;
		$this->proteinsNeeds = $proteinsNeeds;
		$this->$fatNeeds = $fatNeeds;
		$this->carbsNeeds = $carbsNeeds;
	}

	// Getters
	public function getKcalNeeds() {
		return $this->kcalNeeds;
	}

	public function getProteinsNeeds() {
		return $this->proteinsNeeds;
	}

	public function getfatNeeds() {
		return $this->fatNeeds;
	}

	public function getCarbsNeeds() {
		return $this->carbsNeeds;
	}

	// Setters
	public function setKcalNeeds($kcalNeeds) {
		$this->kcalNeeds = $kcalNeeds;
	}

	public function setProteinsNeeds($proteinsNeeds) {
		$this->proteinsNeeds = $proteinsNeeds;
	}

	public function setfatNeeds($fatNeeds) {
		$this->fatNeeds = $fatNeeds;
	}

	public function setCarbsNeeds($carbsNeeds) {
		$this->carbsNeeds = $carbsNeeds;
	}

	public function setNutrient($kcalNeeds, $proteinsNeeds, $fatNeeds, $carbsNeeds) {
		$this->setKcalNeeds($kcalNeeds);
		$this->setProteins($proteinsNeeds);
		$this->setFatNeeds($fatNeeds);
		$this->setCarbs($carbsNeeds);
	}
}