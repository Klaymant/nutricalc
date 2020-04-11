<?php
namespace Config;

class Path {
	const HOST = "http://localhost";
	const PROJECTNAME = "nutricalc";
	const ROOT = PATH::HOST . "/" . PATH::PROJECTNAME;
	const KERNEL = PATH::ROOT . "/index.php";
	const APP = PATH::KERNEL . "/app";
	const API = PATH::KERNEL . "/api";

	const VIEW = PATH::ROOT . "/View";
	const CONTROLLER = PATH::ROOT . "/Controller";
	const MODEL = PATH::ROOT . "/Model";
	const CSS = PATH::ROOT . "/Public/Assets/css";
	const JS = PATH::ROOT . "/Public/Assets/js";
	const IMG = PATH::ROOT . "/Public/Assets/img";
}
?>