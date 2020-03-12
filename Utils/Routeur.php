<?php
namespace Utils;

class Routeur {
    const USER_API_CONTROLLER = 'Controller\Api\UserApiController';
    const USER_CONTROLLER = 'Controller\UserController';

	private $path;

	function __construct($path) {
		$this->path = $path;
	}

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

	private function routeApp() {
		if (array_key_exists(1, $this->path)) {
			switch ($this->path[1]) {
				case 'id':
					if (array_key_exists(2, $this->path)) {
						return ["getUserById", $this->path[2]];
					}
					break;
				case 'calculator':
					return ["calculator"];
					break;
			}
		}
		// fixme : adapt and complete the rest of the function
		/*if (isset($this->$path['id'])) {
			return ['$pathUserById', $this->$path['id']];
		}
		else if (isset($this->$path['calculator'])) {
			return ['calculator'];
		}
		else if (isset($this->$path['usercalculator'])) {
			return ['userCalculator'];
		}
		else if (isset($this->$path['login'])) {
			return ['login'];
		}
		else if (isset($this->$path['account'])) {
			return ['account'];
		}
		else if (isset($this->$path['logout'])) {
			return ['logout'];
		}
		else if (isset($this->$path['dashboard'])) {
			return ['dashboard'];
		}
		else if (isset($this->$path['profile'])) {
			return ['profile'];
		}
		else if (isset($this->$path['changedata'])) {
			return ['changeData'];
		}
		else if (isset($this->$path['savedata'])) {
			return ['saveData'];
		}
		else if (isset($this->$path['newaccount'])) {
			return ['newAccount'];
		}
		else if (isset($this->$path['createaccount'])) {
			return ['createAccount'];
		}
		else if (isset($this->$path['api']) & isset($this->$path['id'])) {
			return ['$pathUserById', $this->$path['id']];
		}
		else if (isset($this->$path['api']) & isset($this->$path['bmr'])) {
			return ['calculateBmr'];
		}
		// If no parameter is set then go to the homepage
		else {
			return ['homepage'];
		}*/
	}

	private function routeApi(){
		if (array_key_exists(1, $this->path)) {
			switch ($this->path[1]) {
				case 'id':
					if (array_key_exists(2, $this->path)) {
						return [self::USER_API_CONTROLLER, "getUserById", $this->path[2]];
					}
					break;
				case 'bmr':
					return ["bmr"]; //fixme
					break;
			}
		}
    }

    private function toggle404(){
        return '404';
    }
}