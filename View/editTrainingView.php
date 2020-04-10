<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\Path;
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
?>

<script type="text/javascript">
	var exoInfo = <?php $exoInfoJs = json_encode($exoInfo); echo "'" . $exoInfoJs . "'"; ?>;
	exoInfo = JSON.parse(exoInfo);
	var exercises = <?php $exercisesJs = json_encode($training->getExercises()); echo "'" . $exercisesJs . "'"; ?>;
	var exoNb = exercises.length + 1;
	console.log(exercises);
	console.log(exoNb);
</script>

<div class="content">
	<?php
		if (isset($errors) AND count($errors) > 0) {
			echo "ERROR!";
		}
	?>
	<form action="<?= PATH::KERNEL?>app/updateTraining" method="post">
		<h1>Edit training</h1>
		<h2>Info of the day</h2>
		<table>
			<tr>
				<td>Date :</td>
				<td><input size=7 type="date" name="date" value="<?= $today ?>"></td>
			</tr>
			<tr>
				<td>Shape :</td>
				<td><input size=1 type="number" min=0 max=10 step=1 value=5 name="shape">/10</td>
			</tr>
		</table>
		<div id="exercises"></div>
		<input class="button" type="submit" value="Modifications made!">
		<input type="hidden" id="trainingId" name="trainingId" value=<?= $trainingId ?>>
	</form>

	<button class="button" onclick="addExo()">
		(+) Add an exercise
	</button>

	<script src="http://localhost/nutricalc/Public/Assets/js/exo.js" type="text/javascript"></script>

</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>