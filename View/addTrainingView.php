<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
?>

<script type="text/javascript">
	var exoNb = 1;
	var exoInfo = <?php $exoInfoJs = json_encode($exoInfo); echo "'" . $exoInfoJs . "'"; ?>;
	exoInfo = JSON.parse(exoInfo);
</script>

<div class="content">
	<form action="savetraining" method="post">
		<h1>New training</h1>
		<table>
			<h2>Info of the day</h2>
			<tr>
				<td>Date :</td>
				<td><input size=7 type="date" name="date" value="<?= $today ?>"></td>
			</tr>
			<tr>
				<td>Shape :</td>
				<td><input size=1 type="number" min=0 max=10 step=1 value=5 name="shape">/10</td>
			</tr>
		</table>
		<table id="exercises"></table>
		<input class="button" type="submit" value="Here is my new training!">
	</form>

	<button class="button" onclick="addExo()">
		(+) Add an exercise
	</button>
</div>

<script src="http://localhost/nutricalc/Public/Assets/js/exo.js" type="text/javascript"></script>

<?php
	$content = ob_get_clean();
	require ("template.php");
?>