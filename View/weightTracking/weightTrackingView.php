<!-- DOCTYPE HTML -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	use Config\PathView;
	use Config\PathAsset;
	use Utils\JsHelper;

	$jsHelper = new JsHelper();
?>

<script type="text/javascript">
	var weightTracking = <?php $jsHelper->jsEncode($weightTracking) ?>;
	weightTracking = weightTracking.reverse();
</script>

<div class="columns is-centered">
	<div class="column is-two-fifths">
		<div class="box has-text-centered">
			<h1 class="title">Your last weights</h1>
			<p>Don't forget that weight is just one parameter and doesn't reflect your corporal composition.</p>
		</div>

		<div class="box">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= PathAsset::JS ?>/weightChart.js"></script>

<?php
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>