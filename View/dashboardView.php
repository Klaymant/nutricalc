<!-- DOCTYPE HTML -->
<?php
	ob_start();
	require_once("Config/Path.php");
	use Config\Path;
?>

<div class="content">
	<p>&#10077;<strong>Hello!</strong></p>
	<p>What are you going to do <strong>today</strong> ?&#10078;</p>
</div>

<div class="tile" id="needs">
	<table>
		<thead>
			<tr>
				<th colspan=2>My daily needs</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="nutrient calories">Calories </td>
				<td><span class="value"><?= round($user->getNutrient()->getKcalNeeds(), 0) ?></span>kcal</td>
			</tr>
			<tr>
				<td class="nutrient proteins">Proteins </td>
				<td><span class="value"><?= round($user->getNutrient()->getProteinsNeeds(), 0) ?></span>g</td>
			</tr>
			<tr>
				<td class="nutrient fat">Fat </td>
				<td><span class="value"><?= round($user->getNutrient()->getFatNeeds(), 0) ?></span>g</td>
			</tr>
			<tr>
				<td class="nutrient carbs">Carbs </td>
				<td><span class="value"><?= round($user->getNutrient()->getCarbsNeeds(), 0) ?></span>g</td>
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
					echo '<tr class="trainingLine">';
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
			<tfoot>
				<tr>
					<td><a class="button" href="<?= PATH::KERNEL ?>app/alltrainings">See all trainings</a></td>
				</tr>
				<tr>
					<td><a class="button" href="addtraining">(+) Add a training</a></td>
				</tr>
			</tfoot>
		</tbody>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>