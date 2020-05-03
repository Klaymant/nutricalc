<?php
    require_once('../public/indexIncludes.php');
	use Utils\Routeur;
	use Utils\UriParser;
	use Controller\UserController;

	date_default_timezone_set('Europe/paris');

	session_start();
	$uri = UriParser::parseUri();
	$routeur = new Routeur($uri);
	$action = $routeur->route();
	if ($action == 'error404') :
		$userController = new UserController();
		$userController->show404();
	else :
	    $controllerName = $action['controller'];
		$methodName = $action['method'];
		$param = isset($action['param']) ? $action['param'] : "";

		$controller = new $controllerName;
		$controller->$methodName($param);
	endif;