<?php
namespace Config;

abstract class Path {
	const HOST = "http://localhost";
	const PROJECTNAME = "nutricalc";
	const ROOT = self::HOST . "/" . self::PROJECTNAME;
	const KERNEL = self::ROOT . "/index.php";
	const APP = self::KERNEL . "/app";
	const API = self::KERNEL . "/api";

	const VIEW = "View";
	const CONTROLLER = self::ROOT . "/Controller";
	const MODEL = self::ROOT . "/Model";
}

abstract class PathView {
	const VIEW = "./View";
	const ACCOUNT = self::VIEW . "/account";
	const TEMPLATE = self::VIEW . "/template";
	const ELEMENT = self::VIEW . "/element";
	const TRAINING = self::VIEW . "/training";
	const WEIGHT_TRACKING = self::VIEW . "/weightTracking";
}

abstract class PathAsset {
	const ASSET = Path::ROOT . "/Public/Assets";
	const CSS = self::ASSET . "/css";
	const JS = self::ASSET . "/js";
	const IMG = self::ASSET . "/img";
}

?>