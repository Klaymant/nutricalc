<?php
namespace Model\Entity;

abstract class Entity {
	public function getAttribute($attributeName) {
		return $this->$attributeName;
	}

	public function setAttribute($attributeName, $value) {
		$this->$attributeName = $value;
	}
}