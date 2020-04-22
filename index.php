<?php
    require_once ('Controller/UserController.php');
    require_once ('Controller/TrainingController.php');
    require_once('Controller/api/UserApiController.php');
    require_once('Utils/Routeur.php');
    require_once('Utils/UriParser.php');
    require_once('Config/Path.php');
    require_once('Utils/JsHelper.php');
	use Utils\Routeur;
	use Utils\UriParser;

	session_start();
	$path = UriParser::parseUri();
	$routeur = new Routeur($path);
	$action = $routeur->route();
	if ($action[1] == "404") {
		echo '404 NOT FOUND';
		exit; //you need to implement this with something else than an exit
	}
    $controllerName = $action[0];
	$methodName = $action[1];
	$param = isset($action[2]) ? $action[2] : "";

	$controller = new $controllerName;
	$controller->$methodName($param);