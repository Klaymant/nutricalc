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
    	$this->trainingRepo->saveTraining($trainingInfo, $_SESSION['id']);
    	header("Location: dashboard");
    }
}