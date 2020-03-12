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
	$method = $action[0]; // Contains the method
	$param = isset($action[1]) ? $action[1] : "";
	var_dump($path);
	var_dump($action);exit;

	// Goes through API Controller
	if (array_key_exists("api", $path)) {
		$userApiController = new UserApiController();
		$userApiController->$method($param);
	}
	else {
		$userController = new UserController();
		$userController->$method($param);
	}