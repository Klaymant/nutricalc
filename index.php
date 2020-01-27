<?php
    require_once ('Controller/GifController.php');
    require_once('Utils/Routeur.php');
	use Controller\GifController;
	use Utils\Routeur;

	$routeur = new Routeur($_GET);
	$action = $routeur->route();
	$function = $action[0];
	$param = isset($action[1]) ? $action[1] : "";
	$gifController = new GifController();
	$gifController->$function($param);