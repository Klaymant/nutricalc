<?php
namespace Utils;

class Routeur {
    const USER_API_CONTROLLER = 'Controller\Api\UserApiController';
    const USER_CONTROLLER = 'Controller\UserController';
    const TRAINING_CONTROLLER = 'Controller\TrainingController';

	private $uri;

	function __construct($uri) {
		$this->uri = $uri;
		$this->error = false;
	}

	public function route(){
        switch ($this->uri[0]){
            case 'app':
                $route = $this->routeApp();
                break;
            case 'api':
                $route = $this->routeApi();
                break;
            default:
                $route = $this->toggle404();
                break;
        }
        return $route;
    }

    // When UserController is chosen
	private function routeApp() {
		if (array_key_exists(1, $this->uri)) {
			switch ($this->uri[1]) {
				case 'homepage':
					$route = [self::USER_CONTROLLER, "homepage"];
					break;
				case 'id':
					if (array_key_exists(2, $this->uri)) {
						$route = [self::USER_CONTROLLER, "getUserById", $this->uri[2]];
						break;
					}
					else {
						$route = [self::USER_CONTROLLER, "404"];
						break;
					}
				case 'calculator':
					$route = [self::USER_CONTROLLER, "calculator"];
					break;
				case 'login':
					$route = [self::USER_CONTROLLER, "login"];
					break;
				case 'logout':
					$route = [self::USER_CONTROLLER, "logout"];
					break;
				case 'account':
					$route = [self::USER_CONTROLLER, "account"];
					break;
				case 'newaccount':
					$route = [self::USER_CONTROLLER, "newAccount"];
					break;
				case 'createaccount':
					$route = [self::USER_CONTROLLER, "createAccount"];
					break;
				case 'dashboard':
					$route = [self::USER_CONTROLLER, "dashboard"];
					break;
				case 'settings':
					$route = [self::USER_CONTROLLER, "settings"];
					break;
				case 'training':
					$route = [self::TRAINING_CONTROLLER, "showTrainingById", $this->uri[2]];
					break;
				case 'addtraining':
					$route = [self::TRAINING_CONTROLLER, "showAddTraining"];
					break;
				case 'edittraining':
					$route = [self::TRAINING_CONTROLLER, "showEditTraining"];
					break;
				case 'savetraining':
					$route = [self::TRAINING_CONTROLLER, "saveTraining"];
					break;
				case 'deletetraining':
					$route = [self::TRAINING_CONTROLLER, "deleteTraining", $this->uri[2]];
					break;
				case 'alltrainings':
					$route = [self::TRAINING_CONTROLLER, "showAllTrainings"];
					break;
				case 'usercalculator':
					$route = [self::USER_CONTROLLER, "userCalculator"];
					break;
				case 'changedata':
					$route = [self::USER_CONTROLLER, "changeData"];
					break;
				case 'savedata':
					$route = [self::USER_CONTROLLER, "saveData"];
					break;
				default:
					$route = [self::USER_CONTROLLER, "404"];
					break;
			}
		}
		else {
			$route =  [self::USER_CONTROLLER, "404"];
		}
		return $route;
	}

	private function routeApi(){
		if (array_key_exists(1, $this->uri)) {
			switch ($this->uri[1]) {
				case 'id':
					// If a parameter is defined in URI
					if (array_key_exists(2, $this->uri)) {
						$route = [self::USER_API_CONTROLLER, "getUserById", $this->uri[2]];
						break;
					}
					else {
						$route = [self::USER_API_CONTROLLER, "404"];
						break;
					}
					break;
				case 'bmr':
					$route = [self::USER_API_CONTROLLER, "calculateBmr"]; //fixme
					break;
				default:
					$route = [self::USER_CONTROLLER, "404"];
			}
			return $route;
		}
    }

    private function toggle404(){
        return '404';
    }
}