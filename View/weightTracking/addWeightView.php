<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	require_once("Config/Path.php");
	use Config\PathView;
?>

<div class="content">
	<form action="addweight" method="post">
		<h1>New weight</h1>
		<table>
			<tr>
				<td>Date :</td>
				<td><input size=7 type="date" name="date" value="<?= $today ?>"></td>
			</tr>
			<tr>
				<td>Weight :</td>
				<td><input size=1 type="number" min=40 max=150 step=1 value=60 name="weight">kg</td>
			</tr>
		</table>
		<input class="button" type="submit" value="Here is my new weight!">
	</form>
</div>

<?php
	$content = ob_get_clean();
	require_once(PathView::TEMPLATE . "/template.php");
?>