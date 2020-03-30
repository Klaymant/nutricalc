<?php
namespace Controller;

require_once('Model/UserRepository.php');
require_once('Model/TrainingRepository.php');
require_once('Model/User.php');
require_once('Model/Training.php');
use Model\UserRepository;
use Model\TrainingRepository;
use Model\User;
use Model\Training;

class UserController {
    private $userRepo;

    public function homepage() {
        require_once ("View/homepageView.php");
    }

    public function calculator() {
        require_once("View/calculatorView.php");
    }

    public function userCalculator() {
        $user = new User($_POST['sex'], $_POST['age'], $_POST['height'], $_POST['weight'], $_POST['activity'], $_POST['goal']);
        $user->calcAllNeeds();
        require_once("View/calculatorView.php");
    }

    public function dashboard() {
        $this->userRepo = new UserRepository();
        $this->trainingRepo = new TrainingRepository();
        $user = $this->userRepo->getUserById($_SESSION['id']);
        $user->calcAllNeeds();

        $trainings = $this->trainingRepo->makeLastTrainings($_SESSION['id'], 5);
        require_once("View/dashBoardView.php");
    }

    public function settings() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserById($_SESSION['id']);

        require_once("View/settingsView.php");
    }

    public function login() {
        require_once ("View/loginView.php");
    }

    public function account() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->getUserByMail($_POST['mail']);
        if ($user['pwd'] == $_POST['pwd']) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['logged'] = true;
            header("Location: dashboard");
        }
        else {
            $error = true;
            require_once ("View/loginView.php");
        }
    }

    public function logout() {
        $_SESSION['logged'] = false;
        session_write_close();
        header ("Location: homepage");
    }

    public function changeData() {
        //$user = $this->userRepo->getUserById($_SESSION['id']);
        require_once("View/accountView.php");
    }

    public function saveData() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->saveData($_POST);
        header("Location: dashboard");
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
}