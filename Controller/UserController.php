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
use Config\PathView;

class UserController {
    private $userRepo;
    private $trainingRepo;

    function __construct() {
        $this->userRepo = new UserRepository();
        $this->trainingRepo = new TrainingRepository();
    }

    /*
    ** ========== 1 - ACCOUNT ==========
    */

    public function showHomepage() {
        require_once (Path::VIEW . "/homepageView.php");
    }

    /*
    ** 1.1 - Connection & deconnection
    */

    public function showLogin() {
        require_once (PathView::ACCOUNT . "/loginView.php");
    }

    public function login() {
        $user = $this->userRepo->getUserByMail($_POST['mail']);
        if ($user != NULL AND password_verify($_POST['pwd'], $user['u_pwd'])) {
            session_start();
            $_SESSION['id'] = $user['u_id'];
            $_SESSION['logged'] = true;
            header("Location: " . Path::APP . "/dashboard");
        }
        else {
            $badLogin = true;
            require_once (PathView::ACCOUNT . "/loginView.php");
        }
    }

    public function logout() {
        $_SESSION['logged'] = false;
        session_write_close();
        header ("Location: " . Path::APP . "/homepage");
    }

    /*
    ** 1.2 - Account creation
    */

    public function showAccountCreator() {
        require_once(PathView::ACCOUNT . "/newAccountView.php");
    }

    public function accountCreator() {
        if ($this->userRepo->mailExists($_POST['mail'])) {
            $error = true;
            require_once(PathView::ACCOUNT . "/newAccountView.php");
        }
        else {
            $data = ['mail'=>$_POST['mail'], 'pwd'=>password_hash($_POST['pwd'], PASSWORD_DEFAULT)];
            $user = $this->userRepo->createAccount($data);
            require_once(PathView::ACCOUNT . "/accountView.php");
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
        require_once(PathView::ACCOUNT . "/forgottenPwdView.php");
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
        require_once(PathView::ACCOUNT . "/newPwdView.php");
    }

    public function changePwd() {
        $newPwd = $_POST['newPwd'];
        $userId = $_POST['userId'];
        $this->userRepo->savePwd($userId, $newPwd);
        header("Location: " . Path::APP . "/dashboard");
    }

    /*
    ** ========== 2 - CALCULATION & TREATMENT ==========
    */

    public function userCalculator() {
        $user = new User($_POST['sex'], $_POST['age'], $_POST['height'], $_POST['weight'], $_POST['activity'], $_POST['goal']);
        $user->calcAllNeeds();
        require_once(Path::VIEW . "/calculatorView.php");
    }

    public function saveData() {
        $this->userRepo = new UserRepository();
        $user = $this->userRepo->saveData($_POST);
        header("Location: " . Path::APP . "/dashboard");
    }

    public function addWeight() {
        $weightDateExists = $this->userRepo->weightDateExists($_SESSION['id'], $_POST['date']);
        if ($weightDateExists) :
            require_once(PathView::WEIGHT_TRACKING . "/addWeightView.php");
        else :
            $this->userRepo->addWeight($_SESSION['id'], $_POST['date'], $_POST['weight']);
            header("Location: " . Path::APP . "/dashboard");
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
        require_once(Path::VIEW . "/dashBoardView.php");
    }

    public function showChangeData() {
        require_once(PathView::ACCOUNT . "/accountView.php");
    }

    public function showSettings() {
        $user = $this->userRepo->getUserById($_SESSION['id']);
        require_once(Path::VIEW . "/settingsView.php");
    }

    public function showCalculator() {
        require_once(Path::VIEW . "/calculatorView.php");
    }

    public function showAddWeight() {
        require_once(PathView::WEIGHT_TRACKING . "/addWeightView.php");
    }

    public function showWeightTracking() {
        $weightTracking = $this->userRepo->makeWeightTracking($_SESSION['id']);
        $amount = 5;
        $weightTracking = array_slice($weightTracking, 0, $amount);
        require_once(PathView::WEIGHT_TRACKING . "/weightTrackingView.php");
    }

    public function show404() {
        require_once(PathView::ERROR . "/error404.php");
    }
}