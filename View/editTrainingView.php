<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	require_once("Config/Path.php");
	use Config\Path;
?>

<script type="text/javascript">
	var exoNb = 1;
	var exoInfo = <?php $exoInfoJs = json_encode($exoInfo); echo "'" . $exoInfoJs . "'"; ?>;
	exoInfo = JSON.parse(exoInfo);
	
	var methodInfo = <?php $methodInfoJs = json_encode($methodInfo); echo "'" . $methodInfoJs . "'"; ?>;
	methodInfo = JSON.parse(methodInfo);
</script>

<div class="content">
	<form action="<?= PATH::APP?>/updateTraining" method="post">
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

	<script src="<?= PATH::JS ?>/exo.js" type="text/javascript"></script>

</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>