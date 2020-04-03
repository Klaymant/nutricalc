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
        $this->trainingRepo = new TrainingRepository();
        $exoInfo = $this->trainingRepo->getAllExercisesInfo();
    	require_once("View/addTrainingView.php");
    }

    public function saveTraining() {
    	$this->trainingRepo = new TrainingRepository();
    	$trainingInfo = ['date' => $_POST['date'], 'shape' => $_POST['shape']];
        $exos = $this->getExosAsArray($_POST);
    	$this->trainingRepo->saveTraining($trainingInfo, $_SESSION['id'], $exos);
    	header("Location: dashboard");
    }

    public function allTrainings() {
        $this->trainingRepo = new TrainingRepository();
        $trainings = $this->trainingRepo->getAllTrainingsById($_SESSION['id']);
        require_once("View/allTrainingsView.php");
    }

    public function getExosAsArray($array) {
        $array = array_slice($array, 2);
        $arrayIndex = 1;
        $nbFields = 5;

        $exercises = [];
        $exo = [];

        foreach ($array as $exoData) {
            array_push($exo, $exoData);
            if ($arrayIndex % $nbFields == 0) {
                array_push($exercises, $exo);
                $exo = [];
            }
            $arrayIndex++;
        }
        return $exercises;
    }
}