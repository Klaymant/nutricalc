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
			. '<td class="firstCol">' . $weight['wt_date'] . '</td>'
			. '<td>' . '<span class="value">' . $weight['wt_weight'] . '</span>kg</td>'
			. '</tr>';
		}
	}
?>

<div class="tile">
	<table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Weight</th>
			</tr>
		</thead>
		<tbody>
			<?php displayWeights($weightTracking); ?>
		</tbody>
	</table>
</div>

<?php
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>