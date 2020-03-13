<?php
namespace Controller\api;

require_once('Model/UserRepository.php');
require_once('Model/User.php');
use Model\UserRepository;
use Model\User;

class UserApiController {
    private $userRepo;

    public function getUserById($id) {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserById($id);

        $userVars = $user->jsonSerialize([]);
        $userVars = json_encode($userVars);
        echo $userVars;
    }

    public function calculateBmr() {
        $user = new User(NULL, NULL, NULL, $_POST['sex'], $_POST['age'], $_POST['height'], $_POST['weight'], $_POST['activity'], $_POST['goal']);
        $user->calculateBmr();

        $userVars = $user->jsonSerialize(["bmr"]);
        $userVars = json_encode($userVars);
        echo $userVars;
        return $userVars;
    }
}