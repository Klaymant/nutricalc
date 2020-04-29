<?php
namespace App\Tests\Repository;
require("Model/UserRepository.php");

use PHPUnit\Framework\TestCase;
use Model\UserRepository;

class UserRepositoryTest extends TestCase {
	private $userRepo;

    /**
    * @dataProvider mailProvider
    */
	public function testGetUserByMail($mail, $expectedId, $expectedPwd) {
		$userRepo = new UserRepository();
		$user = $userRepo->getUserByMail($mail);

		$this->assertEquals($user['u_id'], $expectedId);
		$this->assertEquals($user['u_pwd'], $expectedPwd);
	}

	public function mailProvider() {
    	return [
            'wam'  => ["c.gauthier94250@gmail.com", 1, "$2y$10$4m5TEDraMOzH4xA9iciN7O76ScCCw/sqXX1grmxl8kF3Jwad8GikO"],
            'Yannick' => ["yannickpiault@mescouillessurtonfront.com", 5, "pouetpouet"],
            'unexistingMail' => ["blabla", 0, ""]
        ];
    }

    /**
    * @dataProvider idProvider
    */
	public function testGetMailById($id, $expectedMail) {
		$userRepo = new UserRepository();
		$user = $userRepo->getMailById($id);

		$this->assertEquals($user['u_mail'], $expectedMail);
	}

	public function idProvider() {
    	return [
            'wam'  => [1, "c.gauthier94250@gmail.com"],
            'Yannick' => [5, "yannickpiault@mescouillessurtonfront.com"],
            'unexistingId' => [0, ""]
        ];
    }

    /**
    * @dataProvider userProvider
    */
	public function testGetUserById($id, $expectedUser) {
		$userRepo = new UserRepository();
		$user = $userRepo->getUserById($id);

		$this->assertEquals($user->getSex(), $expectedUser['sex']);
		$this->assertEquals($user->getAge(), $expectedUser['age']);
		$this->assertEquals($user->getHeight(), $expectedUser['height']);
		$this->assertEquals($user->getWeight(), $expectedUser['weight']);
		$this->assertEquals($user->getActivity(), $expectedUser['activity']);
		$this->assertEquals($user->getGoal(), $expectedUser['goal']);
	}

	public function userProvider() {
    	return [
            'wam'  => [1, ['sex'=>'H', 'age'=>26, 'height'=>165, 'weight'=>62, 'activity'=>'High', 'goal'=>'Fat loss']],
            'unexistingId'  => [0, ['sex'=>'', 'age'=>0, 'height'=>0, 'weight'=>0, 'activity'=>'', 'goal'=>'']]
        ];
    }
}