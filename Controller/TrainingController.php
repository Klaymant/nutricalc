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

    public function getnewTrainingInfo() {
        $trainingInfo = ['date' => $_POST['date'], 'shape' => $_POST['shape']];
        $exos = $this->getExosAsArray($_POST);
        return ['trainingInfo' => $trainingInfo, 'exos' => $exos];
    }

    public function saveTraining() {
        $training = $this->getnewTrainingInfo();
    	$this->trainingRepo->addTraining($_SESSION['id'], $training);
    	header("Location: dashboard");
    }

    public function deleteTraining($trainingId) {
        header("Location: " . PATH::KERNEL . "app/dashboard");
        $this->trainingRepo->deleteTraining($trainingId);
    }

    public function updateTraining ($trainingId) {
        $training = $this->getnewTrainingInfo();
        $this->trainingRepo->updateTraining($trainingId, $training);
        header("Location: dashboard");
    }

    public function allTrainings() {
        $trainings = $this->trainingRepo->getAllTrainingsById($_SESSION['id']);
        require_once("View/allTrainingsView.php");
    }

    public function getExosAsArray($array, $cutoff=2, $nbFields=6) {
        $array = array_slice($array, $cutoff);
        $exoList = [];
        $exo = [];
        $i = 1;

        foreach ($array as $exoData) {
            array_push($exo, $exoData);
            if ($i % $nbFields == 0) {
                array_push($exoList, $exo);
                $exo = [];
            }
            $i++;
        }
        return $exoList;
    }
}