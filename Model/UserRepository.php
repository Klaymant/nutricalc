<?php
namespace Model;

require_once ('Model/Repository.php');
require_once ('Model/User.php');
require_once ('Utils/SqlShortcut.php');
require_once ('Config/Path.php');
use Model\Repository;
use Model\User;
use Utils\SqlUserShortcut;
use Config\Path;
use Config\PathView;

class UserRepository extends Repository {
	public function getUserByMail($mail) {
		$query = 'SELECT u_id, u_pwd FROM user WHERE u_mail=?';
		return $this->sqlMaker->make($query, 'fetch', [$mail]);
	}

	public function getUserById($id) {
		$query = SqlUserShortcut::GET_USER_BY_ID;
		$user = $this->sqlMaker->make($query, 'fetch', [$id]);
		return new User($user['u_sex'], $user['u_age'], $user['u_height'], $user['u_weight'], $user['a_name'], $user['g_name'], $id, $user['u_mail'], $user['u_pwd']);
	}

	public function getMailById($userId) {
		$query = "SELECT u_mail FROM user WHERE u_id=?";
		return $this->sqlMaker->make($query, 'fetch', [$userId]);
	}

	public function createUser($age, $height, $weight, $activityId, $goalId) {
		$query = SqlUserShortcut::CREATE_USER;
		return $this->sqlMaker->make($query, NULL, [$height, $weight, $activity, $goal, $age]);
	}

	public function saveData($data) {
		$query = SqlUserShortcut::SAVE_DATA;
		$params = [$data['age'], $data['height'], $data['weight'], $data['activity'], $data['goal'], $_SESSION['id']];
		return $this->sqlMaker->make($query, NULL, $params);
	}

	public function createAccount($data) {
		$query = "INSERT INTO user (u_mail, u_pwd) VALUES (?, ?)";
		return $this->sqlMaker->make($query, NULL, [$data['mail'], $data['pwd']]);
	}

	public function forgottenPwd($user) {
		$userMail = $user->getMail();
		date_default_timezone_set('Europe/paris');
		$dateTime = date('yy-m-d h-i-sa');
		$link = Path::APP . "/newpwd";
		$fileName = "Mail/pwd-rest - ${userMail} - ${dateTime}.txt";
		$message = "Hello dear " . $userMail . "!</br></br>It seems that you asked for changing your password. </br>Follow this <a href='${link}'>link</a> to do it!";
/*		var_dump($fileName);
		exit;*/
		file_put_contents($fileName, $message);
	}

	public function mailExists($mail) {
		$query = "SELECT COUNT(*) as nb_mail FROM user WHERE u_mail=?";
		$mailExists = $this->sqlMaker->make($query, 'fetch', [$mail]);
		return ($mailExists['nb_mail'] == 1) ? true : false;
	}

	public function addWeight($userId, $date, $weight) {
		$query = SqlUserShortcut::ADD_WEIGHT;
		$params = [$userId, $date, $weight];
		$this->sqlMaker->make($query, NULL, $params);
	}

	public function makeWeightTracking($userId, $max=NULL) {
		$query = SqlUserShortcut::GET_WEIGHT_TRACKING_BY_ID;
		$weightTracking = $this->sqlMaker->make($query, "fetchAll", [$userId]);
		return array_slice($weightTracking, 0, $max);
	}
}