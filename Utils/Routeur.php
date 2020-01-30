<?php
namespace Utils;

class Routeur {
	private $get;

	function __construct ($get) {
		$this->get = $get;
	}

	public function route () {
		if (isset($this->get['id'])) {
			return ['getUserById', $this->get['id']];
		}
		else {
			return ['404'];
		}
	}
}