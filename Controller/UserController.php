<?php
namespace Controller;

require_once('Model/UserRepository.php');
use Model\UserRepository;

class UserController {
    private $userRepo;

    public function getUserById($id) {
    	$this->userRepo = new UserRepository();
    	$user = $this->userRepo->getUserById($id);
    }

    private function calculateBmr($user) {
    	$bmr = $user->getSex() == 'H' ?
    	($user->getWeight()*13.707) + ($user->getHeight()*492.2) - ($user->getAge()*6.673) + 77.607 :
    	($user->getWeight()*9.74) + ($user->getHeight()*172.9) - ($user->getAge()*4.737) + 667.05;
    	return $bmr;
    }
}