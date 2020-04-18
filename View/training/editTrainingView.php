<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	require_once("Config/Path.php");
	require_once("Utils/JsHelper.php");
	use Config\Path;
	use Config\PathView;
	Use Config\PathAsset;
	use Utils\JsHelper;

	$jsHelper = new JsHelper();
?>

<script type="text/javascript">
	var exoNb = 1;
	var exoInfo = <?php $jsHelper->jsEncode($exoInfo) ?>;
	var methodInfo = <?php $jsHelper->jsEncode($methodInfo) ?>;
	var exercises = <?php $jsHelper->jsEncode($training['exercises']) ?>;
</script>

<script src="<?= PathAsset::JS ?>/exo.js" type="text/javascript"></script>

<?php
	function displayExos($exercises) {
		foreach ($exercises as $exo) {
			echo "<script type='text/javascript'>displayExos();</script>";
		}
	}
?>

<div class="content">
	<form action="<?= Path::APP ?>/updateTraining" method="post">
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
		<div id="exercises">
			<?php
				displayExos($training['exercises']);
			?>
		</div>
		<input class="button" type="submit" value="Modifications made!">
		<input type="hidden" id="trainingId" name="trainingId" value=<?= $trainingId ?>>
	</form>

	<button class="button" onclick="addExo()">
		(+) Add an exercise
	</button>

	<script src="<?= PathAsset::JS ?>/exo.js" type="text/javascript"></script>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>