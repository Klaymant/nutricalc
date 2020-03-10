<?php
namespace Utils;

class Routeur {
	private $get;

	function __construct($get) {
		$this->get = $get;
	}

	public function route() {
		if (isset($this->get['id'])) {
			return ['getUserById', $this->get['id']];
		}
		else if (isset($this->get['calculator'])) {
			return ['calculator'];
		}
		else if (isset($this->get['usercalculator'])) {
			return ['userCalculator'];
		}
		else if (isset($this->get['login'])) {
			return ['login'];
		}
		else if (isset($this->get['account'])) {
			return ['account'];
		}
		else if (isset($this->get['logout'])) {
			return ['logout'];
		}
		else if (isset($this->get['dashboard'])) {
			return ['dashboard'];
		}
		else if (isset($this->get['profile'])) {
			return ['profile'];
		}
		else if (isset($this->get['changedata'])) {
			return ['changeData'];
		}
		else if (isset($this->get['savedata'])) {
			return ['saveData'];
		}
		else if (isset($this->get['newaccount'])) {
			return ['newAccount'];
		}
		else if (isset($this->get['createaccount'])) {
			return ['createAccount'];
		}
		else if (isset($this->get['api']) & isset($this->get['id'])) {
			return ['getUserById', $this->get['id']];
		}
		else if (isset($this->get['api']) & isset($this->get['bmr'])) {
			return ['calculateBmr'];
		}
		// If no parameter is set then go to the homepage
		else {
			return ['homepage'];
		}
	}
}