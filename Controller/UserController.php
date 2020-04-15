<?php
namespace Controller;

require_once('Model/UserRepository.php');
require_once('Model/TrainingRepository.php');
require_once('Model/User.php');
require_once('Model/Training.php');
require_once('Config/Path.php');
use Model\UserRepository;
use Model\TrainingRepository;
use Model\User;
use Model\Training;
use Config\Path;

class UserController {
    private $userRepo;
    private $trainingRepo;

    function __construct() {
        $this->userRepo = new UserRepository();
        $this->trainingRepo = new TrainingRepository();
    }

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
        $user = $this->userRepo->getUserById($_SESSION['id']);
        $user->calcAllNeeds();
        $mail = $this->userRepo->getMailById($_SESSION['id']);
        $trainings = $this->trainingRepo->makeLastTrainings($_SESSION['id'], 5);
        require_once("View/dashBoardView.php");
    }

    public function settings() {
        $user = $this->userRepo->getUserById($_SESSION['id']);
        require_once("View/settingsView.php");
    }

    public function login() {
        require_once ("View/loginView.php");
    }

    public function account() {
        $user = $this->userRepo->getUserByMail($_POST['mail']);
        if ($user != NULL AND password_verify($_POST['pwd'], $user['pwd'])) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['logged'] = true;
            header("Location: " . PATH::APP . "/dashboard");
        }
        else {
            $badLogin = true;
            require_once ("View/loginView.php");
        }
    }

    public function logout() {
        $_SESSION['logged'] = false;
        session_write_close();
        header ("Location: " . PATH::APP . "/homepage");
    }

    public function changeData() {
        require_once("View/accountView.php");
    }

    public function saveData() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->saveData($_POST);
        header("Location: " . PATH::APP . "/dashboard");
    }

    public function newAccount() {
        require_once("View/newAccountView.php");
    }

    public function createAccount() {
        if ($this->userRepo->mailExists($_POST['mail'])) {
            $error = true;
            require_once("View/newAccountView.php");
        }
        else {
            $data = ['mail'=>$_POST['mail'], 'pwd'=>password_hash($_POST['pwd'], PASSWORD_DEFAULT)];
            $user = $this->userRepo->createAccount($data);
            require_once("View/accountView.php");
        }
    }

    public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activityId, $goalId)
    {
    	$this->userRepo->createUser($mail, $pwd, $sex, $age, $height, $weight, $activityId, $goalId);
    }
}