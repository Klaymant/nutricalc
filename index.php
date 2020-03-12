<?php
    require_once ('Controller/UserController.php');
    require_once('Controller/api/UserApiController.php');
    require_once('Utils/Routeur.php');
    require_once('Utils/UriParser.php');
	use Controller\UserController;
	use Utils\Routeur;
	use Utils\UriParser;
	use Controller\api\UserApiController;

	session_start();

	$path = UriParser::parseUri();
	$routeur = new Routeur($path);
	$action = $routeur->route(); // $action is an array containing a method and the parameters
	$controllerName = $action[0]; // Contains the method
	$method = $action[1];
	$param = isset($action[2]) ? $action[2] : "";
	//var_dump($path);
	//var_dump($action);exit;

	// Goes through API Controller
	$controller = new $controllerName;
	//$controller = new UserApiController;
	$controller->$method($param);