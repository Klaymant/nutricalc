<?php
    require_once ('Controller/UserController.php');
    require_once('Controller/api/UserApiController.php');
    require_once('Utils/Routeur.php');
	use Controller\UserController;
	use Utils\Routeur;
	use Controller\api\UserApiController;

	session_start();
	$routeur = new Routeur($_GET);
	$action = $routeur->route(); // $action is an array containing a method and the parameters
	$function = $action[0]; // Contains the method
	$param = isset($action[1]) ? $action[1] : "";
	if (isset($action[1]) == "api") {
		$userApiController = new UserApiController();
		$userApiController->$function($param);
	}
	else {
		$userController = new UserController();
		$userController->$function($param);
	}