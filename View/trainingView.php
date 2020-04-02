<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<table class="training">
	<thead>
		<tr>
			<td>Date</td>
			<td colspan=2><?= $training->getDate() ?></td>
			<td>Shape</td>
			<td><?= $training->getShape() ?></td>
		</tr>
		<tr>
			<td class ='title exofield'>Exercise</td>
			<td class='exo title'>Sets</td>
			<td class='exo title'>Reps</td>
			<td class='exo title'>Rest</td>
			<td class='exo title'>Method</td>
		</tr>
		<?php
			foreach ($training->getExercises() as $exo) {
				$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
				echo '<tr>' .
					'<td class="exoName">' . $exo->getName() . '</td>' .
					'<td class="exo">' . $exo->getSets() . '</td>' .
					'<td class="exo">' . $exo->getReps() . '</td>' .
					'<td class="exo">' . $exo->getRest() . 's</td>' .
					'<td class="exo">' . $method . '</td>' .
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