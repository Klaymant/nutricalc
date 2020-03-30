<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<table>
	<thead>
		<tr>
			<td colspan=2>Date</td>
			<td>Shape</td>
		</tr>
		<tr>
			<td>Exercise</td>
			<td>Sets</td>
			<td>Reps</td>
			<td>Rest</td>
			<td>Method</td>
		</tr>
		<?php
			foreach ($training->getExercises() as $exo) {
				$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
				echo '<tr>' .
					'<td>' . $exo->getName() . '</td>' .
					'<td>' . $exo->getSets() . '</td>' .
					'<td>' . $exo->getReps() . '</td>' .
					'<td>' . $exo->getRest() . '</td>' .
					'<td>' . $method . '</td>' .
				'</tr>';
			}
		?>
	</thead>
	<tbody>
	</tbody>
</table>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>