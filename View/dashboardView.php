<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<div class="tile" id="needs">
	<table>
		<thead>
			<tr>
				<th colspan=2>My needs</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute">Calories </td>
				<td>| <span class="value"><?= round($user->getNutrient()->getKcalNeeds(), 0) ?></span>kcal</td>
			</tr>
			<tr>
				<td class="attribute">Proteins </td>
				<td>| <span class="value"><?= round($user->getNutrient()->getProteinsNeeds(), 0) ?></span>g</td>
			</tr>
			<tr>
				<td class="attribute">Fat </td>
				<td>| <span class="value"><?= round($user->getNutrient()->getFatNeeds(), 0) ?></span>g</td>
			</tr>
			<tr>
				<td class="attribute">Carbs </td>
				<td>| <span class="value"><?= round($user->getNutrient()->getCarbsNeeds(), 0) ?></span>g</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="tile" id="trainings">
	<table>
		<thead>
			<tr>
				<th colspan=2>My trainings</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Date</td>
				<td>Shape<td>
			</tr>
			<?php
				foreach ($trainings as $training) {
					echo '<tr class="training">';
					$date = '<td><span class="value">' .
					'<a href="training/' . $training->getId() . '">' .
					$training->getDate() . '</a>' .
					'</span></td>';
					$shape = '<td><span class="value">' . $training->getShape() . '</span>/10</td>';
					echo $date;
					echo $shape;
					echo '</tr>';
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan=2><a href="alltraining">See all trainings</a></td>
			</tr>
			<tr>
				<td colspan=2><a href="addtraining">Add a training</a></td>
			</tr>
		</tfoot>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>