<?php
namespace Model\Entity;

require_once('../src/Model/Entity/Entity.php');
use Model\Entity\Entity;

class Nutrient extends Entity {
	protected $kcalNeeds;
	protected $proteinsNeeds;
	protected $fatNeeds;
	protected $carbsNeeds;

	function __construct($kcalNeeds, $proteinsNeeds, $fatNeeds, $carbsNeeds)
	{
		$attributes = [$kcalNeeds, $proteinsNeeds, $fatNeeds, $carbsNeeds];

		foreach ($attributes as $attribute) :
			$this->$attribute = $attribute;
		endforeach;
	}
}