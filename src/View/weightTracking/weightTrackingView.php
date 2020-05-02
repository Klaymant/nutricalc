<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;
	use Utils\JsHelper;

	$today = date('yy-m-d');
	$jsHelper = new JsHelper();
	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();

	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-two-fifths">
		<div class="box has-text-centered">
			<h1 class="title">Your last weights</h1>
			<p>
				Don't forget that weight is just one parameter and doesn't reflect your corporal composition.
			</p>
		</div>

		<div class="box">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div>

<script type="text/javascript">
	var weightTracking = <?php $jsHelper->jsEncode($weightTracking) ?>;
	weightTracking = weightTracking.reverse();
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript" src="<?= $paths['JS'] ?>weightChart.js"></script>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>