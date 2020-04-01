<?php
namespace Controller;

require_once('Model/TrainingRepository.php');
require_once('Model/Training.php');
use Model\TrainingRepository;
use Model\Training;

class TrainingController {
    private $trainingRepo;

    public function training($trainingId) {
        $this->trainingRepo = new TrainingRepository();
        $training = $this->trainingRepo->makeTrainingById($trainingId, $_SESSION['id']);
        require_once("View/trainingView.php");
    }

    public function addTraining() {
    	require_once("View/addTrainingView.php");
    }

    public function saveTraining() {
    	$this->trainingRepo = new TrainingRepository();
    	$trainingInfo = ['date' => $_POST['date'], 'shape' => $_POST['shape']];
        //$exos = getExosAsArray($_POST);
        var_dump($_POST);
        var_dump($exos);
        exit;
    	$this->trainingRepo->saveTraining($trainingInfo, $_SESSION['id'], $exos);
    	header("Location: dashboard");
    }

    public function getExosAsArray($array) {
        $array = array_slice($array, 2);
        $array_size = count($array);
        $exos = [];
        $index = 1;

        for ($i=0; $i<$array_size; $i++) {
            if ($index == 4) {
                $index = 1;
            }


        }
    }
}