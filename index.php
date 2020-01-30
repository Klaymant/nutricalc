<?php
    require_once ('Controller/UserController.php');
    require_once('Utils/Routeur.php');
	use Controller\UserController;
	use Utils\Routeur;

	$routeur = new Routeur($_GET);
	$action = $routeur->route();
	$function = $action[0];
	$param = isset($action[1]) ? $action[1] : "";
	$userController = new UserController();
	$userController->$function($param);