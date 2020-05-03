<?php
namespace Utils;

class Routeur {
    const USER_API_CONTROLLER = 'Controller\Api\UserApiController';
    const USER_CONTROLLER = 'Controller\UserController';
    const TRAINING_CONTROLLER = 'Controller\TrainingController';

	private $uri;
	private $allMethods;
	private $allTags;

	function __construct($uri) {
		$this->uri = $uri;

		$userMethods = [
			['calculator', 'showCalculator', self::USER_CONTROLLER, false],
			['usercalculator', 'userCalculator', self::USER_CONTROLLER, false],
			['dashboard', 'showDashboard', self::USER_CONTROLLER, false],
			['homepage', 'showHomepage', self::USER_CONTROLLER, false]
		];

		$trainingMethods = [
			['training', 'showTrainingById', self::TRAINING_CONTROLLER, true],
			['addtraining', 'showAddTraining', self::TRAINING_CONTROLLER, false],
			['edittraining', 'showEditTraining', self::TRAINING_CONTROLLER, true],
			['updateTraining', 'updateTraining', self::TRAINING_CONTROLLER, false],
			['savetraining', 'saveTraining', self::TRAINING_CONTROLLER, false],
			['deletetraining', 'deleteTraining', self::TRAINING_CONTROLLER, true],
			['alltrainings', 'showAllTrainings', self::TRAINING_CONTROLLER, true]
		];

		$accountMethods = [
			['loginpage', 'showLogin', self::USER_CONTROLLER, false],
			['logout', 'logout', self::USER_CONTROLLER, false],
			['login', 'login', self::USER_CONTROLLER, false],
			['forgottenpwdpage', 'showForgottenPwd', self::USER_CONTROLLER, false],
			['forgottenpwd', 'forgottenPwd', self::USER_CONTROLLER, false],
			['newpwd', 'showNewPwd', self::USER_CONTROLLER, true],
			['changepwd', 'changePwd', self::USER_CONTROLLER, false],
			['newaccount', 'showAccountCreator', self::USER_CONTROLLER, false],
			['createaccount', 'accountCreator', self::USER_CONTROLLER, false],
			['settings', 'showSettings', self::USER_CONTROLLER, false],
			['changedata', 'showChangeData', self::USER_CONTROLLER, false],
			['savedata', 'saveData', self::USER_CONTROLLER, false]
		];

		$weightMethods = [
			['showweight', 'showWeightTracking', self::USER_CONTROLLER, false],
			['showaddweight', 'showAddWeight', self::USER_CONTROLLER, false],
			['addweight', 'addWeight', self::USER_CONTROLLER, false],
			['removeweight', 'removeWeightById', self::USER_CONTROLLER, true]
		];

		$this->allMethods = $this->createMethodsLists(array_merge($trainingMethods, $accountMethods, $weightMethods, $userMethods));
		$this->allTags = $this->getTagsFromMethods($this->allMethods);
	}

	public function route(){
        switch ($this->uri[0]) :
            case 'app':
                $route = $this->routeApp();
                break;
            case 'api':
                $route = $this->routeApi();
                break;
            default:
                $route = $this->toggle404();
                break;
        endswitch;
        return $route;
    }

	private function routeApp() {
		if (array_key_exists(1, $this->uri)) :
			if (in_array($this->uri[1], $this->allTags)) :
				$route = $this->routeMethod();
			else :
				$route = $this->toggle404();
			endif;
		else :
			$route = $this->toggle404();
		endif;
		return $route;
	}

    private function routeMethod() {
    	$tag = $this->uri[1];
    	$param = (array_key_exists(2, $this->uri)) ? $this->uri[2] : NULL;
    	$method = $this->getMethodInfoFromTag($tag)['method'];
    	$controller = $this->getMethodInfoFromTag($tag)['controller'];
    	$hasParam = $this->getMethodInfoFromTag($tag)['hasParam'];

    	return $hasParam ? ['controller'=>$controller, 'method'=>$method , 'param'=>$param] : ['controller'=>$controller, 'method'=>$method];

    }

	private function createMethodsLists($array) {
		$methods = [];
		for ($i=0; $i<count($array); $i++) :
			array_push($methods, ['tag'=>$array[$i][0], 'method'=>$array[$i][1], 'controller'=>$array[$i][2], 'hasParam'=>$array[$i][3]]);
		endfor;
		return $methods;
	}

	private function getMethods() {
		return $this->allMethods;
	}

    private function getTagsFromMethods($methods) {
    	$tags = [];

		foreach ($methods as $method) :
			array_push($tags, $method['tag']);
		endforeach;
		return $tags;
    }

    private function getMethodInfoFromTag($tagValue) {
    	$methods = $this->getMethods();

    	for ($i=0; $i<count($methods); $i++) :
    		if ($tagValue == $methods[$i]['tag']) :
    			return ['method'=>$methods[$i]['method'], 'controller'=>$methods[$i]['controller'], 'hasParam'=>$methods[$i]['hasParam']];
    		endif;
    	endfor;
    }

	private function routeApi(){
		if (array_key_exists(1, $this->uri)) {
			switch ($this->uri[1]) {
				case 'id':
					// If a parameter is defined in URI
					if (array_key_exists(2, $this->uri)) :
						$route = [self::USER_API_CONTROLLER, "getUserById", $this->uri[2]];
						break;
					else :
						$route = [self::USER_API_CONTROLLER, "404"];
						break;
					endif;
				case 'bmr':
					$route = [self::USER_API_CONTROLLER, "calculateBmr"];
					break;
				default:
					$route = [self::USER_CONTROLLER, "404"];
			}
			return $route;
		}
    }

    private function toggle404(){
        return 'error404';
    }
}