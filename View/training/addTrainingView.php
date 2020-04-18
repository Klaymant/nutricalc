<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	require_once("Config/Path.php");
	require_once("Utils/JsHelper.php");
	use Config\Path;
	use Config\PathView;
	use Config\PathAsset;
	use Utils\JsHelper;

	$jsHelper = new JsHelper();
?>

<script type="text/javascript">
	var exoNb = 1;
	var exoInfo = <?php $jsHelper->jsEncode($exoInfo) ?>;
	var methodInfo = <?php $jsHelper->jsEncode($methodInfo) ?>;
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
		<div id="exercises"></div>
		<input class="button" type="submit" value="Here is my new training!">
	</form>

	<button class="button" onclick="addExo()">
		(+) Add an exercise
	</button>
</div>

<script src="<?= PathAsset::JS ?>/exo.js" type="text/javascript"></script>

<?php
	$content = ob_get_clean();
	require_once (PathView::TEMPLATE . "/template.php");
?>