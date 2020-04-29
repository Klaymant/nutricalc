<?php
namespace Controller;

require_once('Model/Repository/UserRepository.php');
require_once('Model/Repository/TrainingRepository.php');
require_once('Model/Entity/User.php');
require_once('Model/Entity/Training.php');
use Model\Repository\UserRepository;
use Model\Repository\TrainingRepository;
use Model\Entity\User;
use Model\Entity\Training;
use Utils\YamlHelper;

class UserController {
    private $userRepo;
    private $trainingRepo;
    private $paths;

    function __construct() {
        $this->userRepo = new UserRepository();
        $this->trainingRepo = new TrainingRepository();
        $yamlHelper = new YamlHelper('path.yaml');
        $this->paths = $yamlHelper->getPaths();
    }

    /*
    ** ========== 1 - ACCOUNT ==========
    */

    public function showHomepage() {
        require_once ($this->paths['USER'] . "homepageView.php");
    }

    /*
    ** 1.1 - Connection & deconnection
    */

    public function showLogin() {
        require_once ($this->paths['ACCOUNT'] . "loginView.php");
    }

    public function login() {
        $user = $this->userRepo->getUserByMail($_POST['mail']);
        if ($user != NULL AND password_verify($_POST['pwd'], $user['u_pwd'])) :
            session_start();
            $_SESSION['id'] = $user['u_id'];
            $_SESSION['logged'] = true;
            header("Location: " . $this->paths['APP'] . "dashboard");
        else :
            $badLogin = true;
            require_once ($this->paths['ACCOUNT'] . "loginView.php");
        endif;
    }

    public function logout() {
        $_SESSION['logged'] = false;
        session_write_close();
        header ("Location: " . $this->paths['APP'] . "homepage");
    }

    /*
    ** 1.2 - Account creation
    */

    public function showAccountCreator() {
        require_once($this->paths['ACCOUNT'] . "newAccountView.php");
    }

    public function accountCreator() {
        if ($this->userRepo->mailExists($_POST['mail'])) {
            $error = true;
            require_once($this->paths['ACCOUNT'] . "newAccountView.php");
        }
        else {
            $data = ['mail'=>$_POST['mail'], 'pwd'=>password_hash($_POST['pwd'], PASSWORD_DEFAULT)];
            $user = $this->userRepo->createAccount($data);
            require_once($this->paths['ACCOUNT'] . "accountView.php");
        }
    }

    public function createUser($mail, $pwd, $sex, $age, $height, $weight, $activityId, $goalId)
    {
        $this->userRepo->createUser($mail, $pwd, $sex, $age, $height, $weight, $activityId, $goalId);
    }

    /*
    ** 1.3 - Password
    */

    public function showForgottenPwd() {
        require_once($this->paths['ACCOUNT'] . "forgottenPwdView.php");
    }

    public function forgottenPwd() {
        $userId = $this->userRepo->getUserByMail($_POST['mail'])['u_id'];
        $user = $this->userRepo->getUserById($userId);
        $this->userRepo->forgottenPwd($user);
    }

    public function showNewPwd($pwdId) {
        $pwdIdExisting = $this->userRepo->resetPwdIdExists($pwdId);
        $userId = $this->userRepo->getUserByResetPwdId($pwdId)['u_id'];
        $userMail = $this->userRepo->getMailById($userId)['u_mail'];
        require_once($this->paths['ACCOUNT'] . "newPwdView.php");
    }

    public function changePwd() {
        $newPwd = $_POST['newPwd'];
        $userId = $_POST['userId'];
        $this->userRepo->savePwd($userId, $newPwd);
        header("Location: " . $this->paths['APP'] . "dashboard");
    }

    /*
    ** ========== 2 - CALCULATION & TREATMENT ==========
    */

    public function userCalculator() {
        $user = new User($_POST['sex'], $_POST['age'], $_POST['height'], $_POST['weight'], $_POST['activity'], $_POST['goal']);
        $user->calcAllNeeds();
        require_once($this->paths['USER'] . "calculatorView.php");
    }

    public function saveData() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->saveData($_POST);
        header("Location: " . $this->paths['APP'] . "dashboard");
    }

    public function addWeight() {
        $weightDateExists = $this->userRepo->weightDateExists($_SESSION['id'], $_POST['date']);
        if ($weightDateExists) :
            require_once($this->paths['WEIGHT_TRACKING'] . "addWeightView.php");
        else :
            $this->userRepo->addWeight($_SESSION['id'], $_POST['date'], $_POST['weight']);
            header("Location: " . $this->paths['APP'] . "dashboard");
        endif;
    }

    /*
    ** ========== 3 - DASHBOARD ==========
    */

    public function showDashboard() {
        $user = $this->userRepo->getUserById($_SESSION['id']);
        $user->calcAllNeeds();
        $mail = $this->userRepo->getMailById($_SESSION['id']);
        $trainings = $this->trainingRepo->makeLastTrainings($_SESSION['id'], 5);
        $weightTracking = $this->userRepo->makeWeightTracking($_SESSION['id'], 5);
        require_once($this->paths['USER'] . "dashBoardView.php");
    }

    public function showChangeData() {
        require_once($this->paths['ACCOUNT'] . "accountView.php");
    }

    public function showSettings() {
        $user = $this->userRepo->getUserById($_SESSION['id']);
        require_once($this->paths['SETTING'] . "settingsView.php");
    }

    public function showCalculator() {
        require_once($this->paths['USER'] . "calculatorView.php");
    }

    public function showAddWeight() {
        require_once($this->paths['WEIGHT_TRACKING'] . "addWeightView.php");
    }

    public function showWeightTracking() {
        $weightTracking = $this->userRepo->makeWeightTracking($_SESSION['id']);
        $amount = 5;
        $weightTracking = array_slice($weightTracking, 0, $amount);
        require_once($this->paths['WEIGHT_TRACKING'] . "weightTrackingView.php");
    }

    public function show404() {
        require_once($this->paths['ERROR'] . "error404.php");
    }
}