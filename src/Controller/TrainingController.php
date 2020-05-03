<?php
namespace Controller;

require_once('../src/Controller/Controller.php');
use Controller\Controller;

class TrainingController extends Controller {

    public function showTrainingById($trainingId) {
        $training = $this->trainingRepo->makeTrainingById($trainingId);
        require_once($this->paths['TRAINING'] . "trainingView.php");
    }

    public function getPaginationFromTrainings($trainings, $pageNb, $amount=5) {
        return array_slice($trainings, ($pageNb-1)*$amount, $amount);
    }

    public function getMaxNbPages($trainings, $amount=5) {
        $value = (count($trainings) % $amount == 0) ? count($trainings) / $amount : count($trainings) / $amount + 1;
        return (int) $value;
    }

    public function checkActualPageNb($pageNb, $maxNbPages) {
        if ($pageNb > $maxNbPages) :
            return $maxNbPages;
        elseif ($pageNb < 1) :
            return 1;
        else :
            return $pageNb;
        endif;
    }

    public function showAllTrainings($pageNb) {
        $nbTrainingsByPage = 2;
        $trainings = $this->trainingRepo->getAllTrainingsById($_SESSION['id']);
        $maxNbPages = $this->getMaxNbPages($trainings, $nbTrainingsByPage);
        $actualPageNb = $this->checkActualPageNb($pageNb, $maxNbPages);
        $trainings = $this->getPaginationFromTrainings($trainings, $actualPageNb, $nbTrainingsByPage);
        $paths = $this->paths;

        require_once($this->paths['TRAINING'] . "allTrainingsView.php");
    }

    public function showAddTraining($error=false) {
        $dateError = $error;
        $exoInfo = $this->trainingRepo->getAllExercisesInfo();
        $methodInfo = $this->trainingRepo->getAllMethodsInfo();
        $paths = $this->paths;
        
       	require_once($this->paths['TRAINING'] . "addTrainingView.php");
    }

    public function showEditTraining($trainingId) {
        $exoInfo = $this->trainingRepo->getAllExercisesInfo();
        $methodInfo = $this->trainingRepo->getAllMethodsInfo();
        $training = $this->trainingRepo->makeTrainingByIdAsArray($trainingId);
        $paths = $this->paths;

        require_once($this->paths['TRAINING'] . "editTrainingView.php");
    }

    public function getTrainingMeta($post) {
        $trainingMeta = [];
        date_default_timezone_set('Europe/paris');
        $today = date('yy-m-d');

        $trainingMeta['date'] = ($post['date'] == NULL) ? $today : $post['date'];
        $trainingMeta['shape'] = ($post['shape'] == NULL) ? 3 : $post['shape'];

        return $trainingMeta;
    }

    public function getnewTrainingInfo() {
        $trainingMeta = $this->getTrainingMeta($_POST);
        $exos = $this->getExosAsArray($_POST);
        return ['trainingMeta' => $trainingMeta, 'exos' => $exos];
    }

    public function saveTraining() {
        $dateError = $this->trainingRepo->dateExists($_SESSION['id'], $_POST['date']);
        if ($dateError) :
            $this->showAddTraining($dateError);
        else :
            $trainingInfo = $this->getnewTrainingInfo();
        	$this->trainingRepo->addTraining($_SESSION['id'], $trainingInfo);
        	header("Location: " . $this->paths['APP'] . "dashboard");
        endif;
    }

    public function deleteTraining($trainingId) {
        header("Location: " . $this->paths['APP'] . "dashboard");
        $this->trainingRepo->deleteTraining($trainingId);
    }

    public function updateTraining () {
        $training = $this->getnewTrainingInfo();
        $this->trainingRepo->updateTraining($_POST['trainingId'], $training);
        header("Location: " . $this->paths['APP'] . "dashboard");
    }

    public function getExosAsArray($array, $cutoff=2, $nbFields=6) {
        $array = array_slice($array, $cutoff);
        $exoList = [];
        $exo = [];
        $i = 1;

        foreach ($array as $exoData) :
            $exoData = $exoData == NULL ? 0 : $exoData;
            array_push($exo, $exoData);

            if ($i % $nbFields == 0) :
                array_push($exoList, $exo);
                $exo = [];
            endif;

            $i++;
        endforeach;
        return $exoList;
    }
}