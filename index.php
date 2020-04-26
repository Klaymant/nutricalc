<?php
    require_once ('Controller/UserController.php');
    require_once ('Controller/TrainingController.php');
    require_once ('Controller/api/UserApiController.php');
    require_once ('Utils/Routeur.php');
    require_once ('Utils/UriParser.php');
    require_once ('Config/Path.php');
    require_once ('Utils/JsHelper.php');
    require_once ('Utils/YamlHelper.php');
    require_once ('Controller/UserController.php');
	use Utils\Routeur;
	use Utils\UriParser;
	use Controller\UserController;

	date_default_timezone_set('Europe/paris');

	session_start();
	$path = UriParser::parseUri();
	$routeur = new Routeur($path);
	$action = $routeur->route();
	if ($action == 'error404') :
		$userController = new UserController();
		$userController->show404();
	else :
	    $controllerName = $action[0];
		$methodName = $action[1];
		$param = isset($action[2]) ? $action[2] : "";

		$controller = new $controllerName;
		$controller->$methodName($param);
	endif;