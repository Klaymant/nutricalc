<?php
    require_once ('Controller/UserController.php');
    require_once('Controller/api/UserApiController.php');
    require_once('Utils/Routeur.php');
	use Controller\UserController;
	use Utils\Routeur;
	use Controller\api\UserApiController;

	session_start();

	$uri = $_SERVER['REQUEST_URI'];
	$uri = trim($uri, "/");
	$path = explode("/", $uri);
	$path = array_splice($path, 2);
	$path = array_flip($path);

	$routeur = new Routeur($path);
	$action = $routeur->route(); // $action is an array containing a method and the parameters
	$method = $action[0]; // Contains the method
	$param = isset($action[1]) ? $action[1] : "";

	//var_dump($path);
	//exit;

	// Goes through API Controller
	if (array_key_exists("api", $path)) {
		$userApiController = new UserApiController();
		$userApiController->$method($param);
	}
	else {
		$userController = new UserController();
		$userController->$method($param);
	}