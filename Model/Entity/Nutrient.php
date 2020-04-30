<?php
namespace Model\Entity;

class Nutrient {
	private $kcalNeeds;
	private $proteinsNeeds;
	private $fatNeeds;
	private $carbsNeeds;

	function __construct($kcalNeeds, $proteinsNeeds, $fatNeeds, $carbsNeeds)
	{
		$this->kcalNeeds = $kcalNeeds;
		$this->proteinsNeeds = $proteinsNeeds;
		$this->fatNeeds = $fatNeeds;
		$this->carbsNeeds = $carbsNeeds;
	}

	public function getAttribute($attributeName) {
		return $this->{$attributeName};
	}

	public function setAttribute($attributeName, $value) {
		$this->{$attributeName} = $value;
	}

	public function setNutrient($kcalNeeds, $proteinsNeeds, $fatNeeds, $carbsNeeds) {
		$this->setAttribute("kcalNeeds", $kcalNeeds);
		$this->setAttribute("proteinsNeeds", $proteinsNeeds);
		$this->setAttribute("fatNeeds", $fatNeeds);
		$this->setAttribute("carbsNeeds", $carbsNeeds);
	}
}