<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<?php
	foreach ($trainings as $trainee) {
		echo "<table class='training'>
			<thead>
				<tr>
					<td>Date</td>
					<td>" . $trainee->getDate() . "</td>
				</tr>
				<tr>
					<td>Shape</td>
					<td>" . $trainee->getShape() . "</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Exercise</td>
					<td>Sets</td>
					<td>Reps</td>
					<td>Rest</td>
					<td>Method</td>
				</tr>
";
		foreach ($trainee->getExercises() as $exo) {
			$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
			echo '<tr>' .
				'<td>' . $exo->getName() . '</td>' .
				'<td>' . $exo->getSets() . '</td>' .
				'<td>' . $exo->getReps() . '</td>' .
				'<td>' . $exo->getRest() . '</td>' .
				'<td>' . $method . '</td>' .
			'</tr>';
		}
			echo "<tbody>
		</table>";
	}
?>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>