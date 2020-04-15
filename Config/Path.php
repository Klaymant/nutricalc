<?php
namespace Config;

class Path {
	const HOST = "http://localhost";
	const PROJECTNAME = "nutricalc";
	const ROOT = self::HOST . "/" . self::PROJECTNAME;
	const KERNEL = self::ROOT . "/index.php";
	const APP = self::KERNEL . "/app";
	const API = self::KERNEL . "/api";

	const VIEW = self::ROOT . "/View";
	const CONTROLLER = self::ROOT . "/Controller";
	const MODEL = self::ROOT . "/Model";
	const CSS = self::ROOT . "/Public/Assets/css";
	const JS = self::ROOT . "/Public/Assets/js";
	const IMG = self::ROOT . "/Public/Assets/img";
}
?>