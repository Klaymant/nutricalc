<?php
namespace Utils;

class YamlHelper {
	public static function getPaths($fileName) {
		$yamlFile = "../config/" . $fileName;
		$yamlFile = yaml_parse_file($yamlFile);
		$yamlFile = array_slice($yamlFile, 1);
		$paths = [];

		foreach ($yamlFile as $tags) {
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