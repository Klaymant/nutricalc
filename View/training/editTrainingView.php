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
		foreach ($exercises as $exo) :
?>
			<script type='text/javascript'>displayExos();</script>
		<?php
		endforeach;
	}
	?>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h1 class="title">Edit training</h1>
			<p>
				You made more efforts, didn't you ?
			</p>
		</div>

		<div class="content">
			<form action="<?= Path::APP ?>/updateTraining" method="post">
				<div class="box">
					<h2 class="subtitle has-text-centered">Info of the day</h2>
					<div class="field">
						<label class="label">Date</label>
						<input class="input" size=7 type="date" name="date" value="<?= $today ?>">
					</div>

					<div class="field">
						<label class="label">Shape</label>
						<input class="input" size=1 type="number" min=0 max=10 step=1 placeholder="Your shape out of 10" name="shape">
					</div>
				</div>

				<div class="box" id="exercises">
					<?php
						displayExos($training['exercises']);
					?>
				</div>
				<div class="buttons">
					<input class="button is-success" value="(+) Add an exercise" onclick="addExo()">
					<input class="button is-info" type="submit" value="Modifications made!">
					<input type="hidden" id="trainingId" name="trainingId" value=<?= $trainingId ?>>
				</div>
			</form>
		</div>

		<script src="<?= PathAsset::JS ?>/exo.js" type="text/javascript"></script>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>