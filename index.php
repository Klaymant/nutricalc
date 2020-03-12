<?php
    require_once ('Controller/UserController.php');
    require_once('Controller/api/UserApiController.php');
    require_once('Utils/Routeur.php');
    require_once('Utils/UriParser.php');
	use Utils\Routeur;
	use Utils\UriParser;

	session_start();
	$path = UriParser::parseUri();
	$routeur = new Routeur($path);
	$action = $routeur->route();
    $controllerName = $action[0];
	$method = $action[1];
	$param = isset($action[2]) ? $action[2] : "";
	$controller = new $controllerName;
	$controller->$method($param);