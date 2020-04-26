<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;
	use Utils\JsHelper;

	$today = date('yy-m-d');
	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
	$jsHelper = new JsHelper();

	ob_start();
?>

<script type="text/javascript">
	var exoNb = 1;
	var exoInfo = <?php $jsHelper->jsEncode($exoInfo) ?>;
	var methodInfo = <?php $jsHelper->jsEncode($methodInfo) ?>;
</script>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h1 class="title">New training</h1>
			<p>
				Show me what you've got!
			</p>
		</div>

		<?php if (isset($dateError) && $dateError) : ?>
			<div class="box has-background-danger has-text-white has-text-centered">
				<p>You can't train twice a day!</p>
			</div>
		<?php endif; ?>

		<div class="content">
			<form action="savetraining" method="post">
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

				<h2 class="subtitle has-text-centered">Exercises made with pleasure and pain</h2>
				<div class="box" id="exercises"></div>
				<div class="buttons">
					<input class="button is-success" type="button" value="(+) Add an exercise" onclick="addExo()">
					<input class="button is-info" type="submit" value="Here is my new training!">
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= $paths['JS'] ?>exo.js" type="text/javascript"></script>

<?php
	$content = ob_get_clean();
	require_once ($paths['TEMPLATE'] . "template.php");
?>