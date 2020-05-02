<?php
namespace Utils;

class YamlHelper {
	private $yamlFile;

	function __construct($fileName) {
		$this->yamlFile = "../config/" . $fileName;
		$this->yamlFile = yaml_parse_file($this->yamlFile);
		$this->yamlFile = array_slice($this->yamlFile, 1);
	}

	public function getPaths() {
		$paths = [];

		foreach ($this->yamlFile as $tags) {
			foreach ($tags as $tag) {
				foreach ($tag as $element) {
					$paths[key($tag)] = "";
					foreach ($element as $elem) {
						$paths[key($tag)] .= $elem;
					}
				}
			}
		}
		return $paths;
	}
}