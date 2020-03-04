<?php
    require_once ('Controller/UserController.php');
    require_once('Controller/api/UserApiController.php');
    require_once('Utils/Routeur.php');
	use Controller\UserController;
	use Utils\Routeur;
	use Controller\api\UserApiController;

	session_start();
	$routeur = new Routeur($_GET);
	$action = $routeur->route();
	$function = $action[0];
	$param = isset($action[1]) ? $action[1] : "";
	$userApiController = new UserApiController();
	$userApiController->$function($param);
	//$userController = new UserController();
	//$userController->$function($param);