<?php
namespace Controller\api;

require_once('Model/UserRepository.php');
require_once('Model/User.php');
use Model\UserRepository;
use Model\User;

class UserApiController {
    private $userRepo;

    function getUserById($id) {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserById($id);

        $userVars = json_encode($user->jsonSerialize());
        echo $userVars;
    }
}