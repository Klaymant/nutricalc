<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\Path;
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
?>

<script type="text/javascript">
	var exoNb = 2;
	var exoInfo = <?php $exoInfoJs = json_encode($exoInfo); echo "'" . $exoInfoJs . "'"; ?>;
	exoInfo = JSON.parse(exoInfo);
</script>

<div class="content">
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
		<table id="exercises">
			<h2>Exercises</h2>
			<tr>
				<h3>Exercice 1</h3>
			</tr>
			<tr>
				<td>Name :</td>
				<td>
					<select name="name_1">
						<?php
							foreach ($exoInfo as $info) {
								echo '<option value="' . $info['id'] . '">' . $info['name'] . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Work load :</td>
				<td><input size=1 type="number" min=0 value=10 name="workload_1">kg</td>
			</tr>
			<tr>
				<td>Rest :</td>
				<td><input type="number" min=10 step=10 value=60 name="rest_1">seconds</td>
			</tr>
			<tr>
				<td>Number of sets :</td>
				<td><input size=1 type="number" min=0 max=10 step=1 value=4 name="sets_1"></td>
			</tr>
				<td>Number of reps :</td>
				<td><input size=1 type="number" min=0 max=100 step=1 value=10 name="reps_1"></td>
			<tr>
				<td>Method :</td>
				<td><input type="text" name="method_1"></td>
			</tr>
		</table>
		<input class="button" type="submit" value="Modifications made!">
		<input type="hidden" id="trainingId" name="trainingId" value=<?= $trainingId ?>>
	</form>

	<button class="button" onclick="addExo()">
		+ Add another exercise
	</button>

	<script src="http://localhost/nutricalc/Public/Assets/js/addexo.js" type="text/javascript"></script>

</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>