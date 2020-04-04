<?php
namespace Controller;

require_once('Model/TrainingRepository.php');
require_once('Model/Training.php');
require_once('Config/Path.php');
use Model\TrainingRepository;
use Model\Training;
use Config\Path;

class TrainingController {
    private $trainingRepo;

    function __construct() {
        $this->trainingRepo = new TrainingRepository();
    }

    public function training($trainingId) {
        $training = $this->trainingRepo->makeTrainingById($trainingId, $_SESSION['id']);
        require_once("View/trainingView.php");
    }

    public function addTraining() {
        $exoInfo = $this->trainingRepo->getAllExercisesInfo();
    	require_once("View/addTrainingView.php");
    }

    public function saveTraining() {
    	$trainingInfo = ['date' => $_POST['date'], 'shape' => $_POST['shape']];
        $exos = $this->getExosAsArray($_POST);
    	$this->trainingRepo->saveTraining($trainingInfo, $_SESSION['id'], $exos);
    	header("Location: dashboard");
    }

    public function deleteTraining($trainingId) {
        header("Location: " . PATH::KERNEL . "app/dashboard");
        $this->trainingRepo->deleteTraining($trainingId);
    }

    public function allTrainings() {
        $trainings = $this->trainingRepo->getAllTrainingsById($_SESSION['id']);
        require_once("View/allTrainingsView.php");
    }

    public function getExosAsArray($array) {
        $array = array_slice($array, 2);
        $arrayIndex = 1;
        $nbFields = 6;

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