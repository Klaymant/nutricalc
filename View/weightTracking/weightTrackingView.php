<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	require_once("Config/Path.php");
	use Config\PathView;

	function displayWeights($weightTracking) {
		foreach($weightTracking as $weight) {
			echo '<tr>'
			. '<td>' . $weight['wt_date'] . '</td>'
			. '<td class="has-text-right">' . '<span class="value">' . $weight['wt_weight'] . '</span>kg</td>'
			. '</tr>';
		}
	}
?>

<div class="columns is-centered">
	<div class="column is-one-fifth">
		<div class="box">
			<h1 class="title">All my weight Tracking</h1>
		</div>
		<table class="table is-fullwidth">
			<thead>
				<tr>
					<th>Date</th>
					<th class="has-text-right">Weight</th>
				</tr>
			</thead>
			<tbody>
				<?php displayWeights($weightTracking); ?>
			</tbody>
		</table>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>