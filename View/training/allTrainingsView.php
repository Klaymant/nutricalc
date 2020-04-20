<!-- DOCTYPE HTML -->
<?php
	ob_start();
	use Config\PathView;
?>

<div class="columns is-centered">
	<?php
		foreach ($trainings as $trainee) {
			echo '
			<div class="column">
				<div class="box">
					<h2 class="subtitle is-5">Date : ' . $trainee->getDate() . '</h2>' .
					'<h2 class="subtitle">Shape : ' . $trainee->getShape() . '</h2>'.
				'</div>
				<table class="table is-fullwidth is-narrow">
					<thead>
						<tr>
							<th>Exercise</th>
							<th>Work load</th>
							<th>Sets</th>
							<th>Reps</th>
							<th>Rest</th>
							<th>Method</th>
						</tr>
					</thead>
					<tbody>';
				foreach ($trainee->getExercises() as $exo) {
					$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
					echo '<tr>' .
						'<td>' . $exo->getName() . '</td>' .
						'<td class="has-text-centered">' . $exo->getWorkLoad() . 'kg</td>' .
						'<td class="has-text-centered">' . $exo->getSets() . '</td>' .
						'<td class="has-text-centered">' . $exo->getReps() . '</td>' .
						'<td class="has-text-centered">' . $exo->getRest() . 's</td>' .
						'<td class="has-text-centered">' . $method . '</td>' .
					'</tr>';
				}
					echo "<tbody>
				</table>
			</div>";
		}
	?>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>