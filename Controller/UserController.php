<?php
namespace Controller;

require_once('Model/UserRepository.php');
use Model\UserRepository;

class UserController {
    private $userRepo;

    // Displays the homepage
    public function homepage() {
        require_once ("View/homepageView.php");
    }

    public function profile() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserById($_SESSION['id']);
        $bmr = $this->calculateBmr($user);
        $user->setBmr($bmr);
        $kcalNeeds = $this->kcalNeeds($user);
        $proteins = $user->getWeight() * 1.6;
        $fat = $user->getWeight();
        $carbs = ($kcalNeeds-($proteins*4)-($fat*9))/4;

        $user->setNutrient($kcalNeeds, $proteins, $fat, $carbs);
        require_once("View/profileView.php");
    }

    public function dashboard() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserById($_SESSION['id']);
        $bmr = $this->calculateBmr($user);
        $user->setBmr($bmr);
        $kcalNeeds = $this->kcalNeeds($user);
        $proteins = $user->getWeight() * 1.6;
        $fat = $user->getWeight();
        $carbs = ($kcalNeeds-($proteins*4)-($fat*9))/4;

        $user->setNutrient($kcalNeeds, $proteins, $fat, $carbs);
        require_once("View/dashBoardView.php");
    }

    public function login() {
        require_once ("View/loginView.php");
    }

    public function account() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserByMail($_POST['mail']);
        if ($user['pwd'] == $_POST['pwd']) {
            $_SESSION['id'] = $user['id'];
            header("Location: index.php?dashboard");
        }
        else {
            $error = true;
            require_once ("View/loginView.php");
        }
    }

    public function changeData() {
        require_once("View/accountView.php");
    }

    public function saveData() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->saveData($_POST);
        header("Location: index.php?dashboard");
    }

    public function newAccount()
    {
        require_once("View/newAccountView.php");
    }

    public function createAccount() {
        $this->userRepo = new UserRepository();
        if ($this->userRepo->mailExists($_POST['mail'])) {
            $error = true;
            require_once("View/newAccountView.php");
        }
        else {
            $user = $this->userRepo->createAccount($_POST);
            require_once("View/accountView.php");
        }
    }

    public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activityId, $goalId)
    {
    	$userRepo = new UserRepository;
    	$this->userRepo->createUser($mail, $pwd, $sex, $age, $height, $weight, $activityId, $goalId);
    }

    private function calculateBmr($user) {
    	$menFormula = ($user->getWeight()*13.707) + ($user->getHeight()/100*492.2) - ($user->getAge()*6.673) + 77.607;
    	$womenFormula = ($user->getWeight()*9.74) + ($user->getHeight()*172.9) - ($user->getAge()*4.737) + 667.05;
    	
    	return $user->getSex() == 'H' ? $menFormula : $womenFormula;
    }

    private function activityQuotient($activity) {
    	switch ($activity) {
    		case "Any":
    			return 1;
    		case "Low":
    			return 1.2;
    		case "Moderate":
    			return 1.37;
    		case "High":
    			return 1.5;
    		case "Very high":
    			return 1.8;
    	}
    }

    // Calculate the kcal needs depending on the activity quotient, BMR and the wanted goal
    private function kcalNeeds($user) {
    	switch ($user->getGoal()) {
    		case "Fat loss":
    			return ($user->getBmr()*$this->activityQuotient($user->getActivity())*0.8);
    		case "Maintain":
    			return ($user->getBmr()*$this->activityQuotient($user->getActivity())*1);
    		case "Mass gain":
    			return ($user->getBmr()*$this->activityQuotient($user->getActivity())*1.2);
    	}
    }
}