<?php
namespace Utils;

class Routeur {
	private $get;

	function __construct ($get) {
		$this->get = $get;
	}

	public function route () {
		if (isset($this->get['add'])) {
			return ['createGif'];
		}			
		else if (isset($this->get['random'])) {
			return ['getRandomGif'];
		}
		else if (isset($this->get['all'])) {
			return ['getAllGifs'];
		}
		else if (isset($this->get['id'])) {
			return ['getById', $this->get['id']];
		}
		else {
			return ['404'];
		}
	}
}