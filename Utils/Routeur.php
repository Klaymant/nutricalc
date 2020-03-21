<?php
namespace Utils;

class Routeur {
    const USER_API_CONTROLLER = 'Controller\Api\UserApiController';
    const USER_CONTROLLER = 'Controller\UserController';

	private $path;

	function __construct($path) {
		$this->path = $path;
		$this->error = false;
	}

	// Depending on the route of the URI, either a UserController or a UserApiController will be chosen in the index
	public function route(){
        switch ($this->path[0]){
            case 'app':
                return $this->routeApp();
                break;
            case 'api':
                return $this->routeApi();
                break;
            default:
                return $this->toggle404();
                break;
        }
    }

    // When UserController is chosen
	private function routeApp() {
		if (array_key_exists(1, $this->path)) {
			switch ($this->path[1]) {
				case 'homepage':
					return [self::USER_CONTROLLER, "homepage"];
					break;
				case 'id':
					if (array_key_exists(2, $this->path)) {
						return [self::USER_CONTROLLER, "getUserById", $this->path[2]];
						break;
					}
					else {
						return [self::USER_CONTROLLER, "404"];
						break;
					}
				case 'calculator':
					return [self::USER_CONTROLLER, "calculator"];
					break;
				case 'login':
					return [self::USER_CONTROLLER, "login"];
					break;
				case 'logout':
					return [self::USER_CONTROLLER, "logout"];
					break;
				case 'account':
					return [self::USER_CONTROLLER, "account"];
					break;
				case 'newaccount':
					return [self::USER_CONTROLLER, "newAccount"];
					break;
				case 'createaccount':
					return [self::USER_CONTROLLER, "createAccount"];
					break;
				case 'dashboard':
					return [self::USER_CONTROLLER, "dashboard"];
					break;
				case 'usercalculator':
					return [self::USER_CONTROLLER, "userCalculator"];
					break;
				case 'changedata':
					return [self::USER_CONTROLLER, "changeData"];
					break;
				case 'savedata':
					return [self::USER_CONTROLLER, "saveData"];
					break;
				default:
					return [self::USER_CONTROLLER, "404"];
			}
		}
		else {
			return [self::USER_CONTROLLER, "404"];
		}
	}

	// When UserApiController is chosen
	private function routeApi(){
		if (array_key_exists(1, $this->path)) {
			switch ($this->path[1]) {
				case 'id':
					// If a parameter is defined in URI
					if (array_key_exists(2, $this->path)) {
						return [self::USER_API_CONTROLLER, "getUserById", $this->path[2]];
						break;
					}
					else {
						return [self::USER_API_CONTROLLER, "404"];
						break;
					}
					break;
				case 'bmr':
					return [self::USER_API_CONTROLLER, "calculateBmr"]; //fixme
					break;
				default:
					return [self::USER_CONTROLLER, "404"];
			}
		}
    }

    private function toggle404(){
        return '404';
    }
}