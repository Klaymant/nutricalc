<?php
namespace Utils;

class YamlHelper {
	private $yamlFile;

	function __construct() {
		$this->yamlFile = "Config/path.yaml";
		$this->yamlFile = yaml_parse_file($this->yamlFile);
		$this->yamlFile = array_slice($this->yamlFile, 1);
	}

	public function getPaths() {
		$paths = [];

		foreach ($this->yamlFile as $line):
			foreach ($line as $element):
				$paths[$element['shortcut']] = $element['path'];
			endforeach;
		endforeach;
		return $paths;
	}
}