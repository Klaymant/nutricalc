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
}