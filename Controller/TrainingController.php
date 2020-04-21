<?php
namespace Controller;

require_once('Model/TrainingRepository.php');
require_once('Model/Training.php');
require_once('Config/Path.php');
use Model\TrainingRepository;
use Model\Training;
use Config\Path;
use Config\PathView;

class TrainingController {
    private $trainingRepo;

    function __construct() {
        $this->trainingRepo = new TrainingRepository();
    }

    public function showTrainingById($trainingId) {
        $training = $this->trainingRepo->makeTrainingById($trainingId);
        require_once(PathView::TRAINING . "/trainingView.php");
    }

    public function getPaginationFromTrainings($trainings, $pageNb, $amount=5) {
        return array_slice($trainings, ($pageNb-1)*$amount, $amount);
    }

    public function getMaxNbPages($trainings, $amount=5) {
        $value = (count($trainings) % $amount == 0) ? count($trainings) / $amount : count($trainings) / $amount + 1;
        return (int) $value;
    }

    public function showAllTrainings($pageNb) {
        $actualPageNb = $pageNb;
        $nbTrainingsByPage = 5;
        $trainings = $this->trainingRepo->getAllTrainingsById($_SESSION['id']);
        $maxNbPages = $this->getMaxNbPages($trainings, $nbTrainingsByPage);
        $trainings = $this->getPaginationFromTrainings($trainings, $pageNb, $nbTrainingsByPage);

        require_once(PathView::TRAINING . "/allTrainingsView.php");
    }

    public function showAddTraining() {
        $exoInfo = $this->trainingRepo->getAllExercisesInfo();
        $methodInfo = $this->trainingRepo->getAllMethodsInfo();
       	require_once(PathView::TRAINING . "/addTrainingView.php");
    }

    public function showEditTraining($trainingId) {
        $exoInfo = $this->trainingRepo->getAllExercisesInfo();
        $methodInfo = $this->trainingRepo->getAllMethodsInfo();
        $training = $this->trainingRepo->makeTrainingByIdAsArray($trainingId);
        require_once(PathView::TRAINING . "/editTrainingView.php");
    }

    public function checkForm($form) {
        $errors = [];

        foreach ($form as $field=>$value) {
            if ($value == NULL) {
                $fieldName = explode("_", $field)[0];
                $fieldNumber = explode("_", $field)[1];
                array_push($errors, ["fieldName"=>$fieldName, "fieldNumber"=>$fieldNumber]);
            }
        }
        return $errors;
    }

    public function getnewTrainingInfo() {
        $trainingMeta = ['date' => $_POST['date'], 'shape' => $_POST['shape']];
        $exos = $this->getExosAsArray($_POST);
        return ['trainingMeta' => $trainingMeta, 'exos' => $exos];
    }

    public function saveTraining() {
        $dateError = $this->trainingRepo->dateExists($_SESSION['id'], $_POST['date']);
        if ($dateError) {
            require(PathView::TRAINING . "/addtrainingView.php");
        }
        else {
            $trainingInfo = $this->getnewTrainingInfo();
        	$this->trainingRepo->addTraining($_SESSION['id'], $trainingInfo);
        	header("Location: " . PATH::APP . "/dashboard");
        }
    }

    public function deleteTraining($trainingId) {
        header("Location: " . PATH::APP . "/dashboard");
        $this->trainingRepo->deleteTraining($trainingId);
    }

    public function updateTraining () {
        $training = $this->getnewTrainingInfo();
        $this->trainingRepo->updateTraining($_POST['trainingId'], $training);
        header("Location: " . PATH::APP . "/dashboard");
    }

    public function getExosAsArray($array, $cutoff=2, $nbFields=6) {
        $array = array_slice($array, $cutoff);
        $exoList = [];
        $exo = [];
        $i = 1;

        foreach ($array as $exoData) {
            $exoData = $exoData == NULL ? 0 : $exoData;
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