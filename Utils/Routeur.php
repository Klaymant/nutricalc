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
		else if (isset($this->get['login'])) {
			return ['login'];
		}
		else if (isset($this->get['account'])) {
			return ['account'];
		}
		else if (isset($this->get['savedata'])) {
			return ['saveData'];
		}
		// If no parameter is set then go to the homepage
		else {
			return ['homepage'];
		}
	}
}