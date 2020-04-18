<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\Path;
	use Config\PathView;
	ob_start();

	function displayWeights($weightTracking) {
		echo '<tr>
				<td>Date</td>
				<td>Weight</td>
			</tr>';
		foreach($weightTracking as $weightData) {
			echo '
			<tr>
				<td class="firstCol">&#10026; ' . $weightData['wt_date'] . '</td>
				<td>' . '<span class="value">' . $weightData['wt_weight'] . '</span>kg</td>
			</tr>';
		}
	}

		function showLastTrainings($trainings) {
		foreach ($trainings as $training) {
			echo '<tr class="trainingLine">';
			$date = '<td class="firstCol">&#10026; <span class="value">' .
			'<a href="training/' . $training->getId() . '">' .
			$training->getDate() . '</a>' .
			'</span></td>';
			$shape = '<td><span class="value">' . $training->getShape() . '</span>/10</td>';
			echo $date;
			echo $shape;
			echo '</tr>';
		}
	}
?>

<div id="welcome" class="content">
	<p>&#10077; Hello <span class="userName"><?= $mail['u_mail'] ?></span>! 🙋‍♂️ &#10078;</p>
	<?php
		if (isset($trainings[0]))
		{
			echo "<p>&#10077; The last time you 💪 was the <strong>" . $trainings[0]->getDate() . "</strong> &#10078;</p>";
		}
	?>
</div>

<!--
---- TILE 1 : DAILY NEEDS
-->
	<div class="tile" id="needs">
		<table>
			<thead>
				<tr>
					<th colspan=2>🍌 My daily needs</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="nutrient calories" width="10px">Calories</td>
					<td><span class="value"><?= round($user->getNutrient()->getKcalNeeds(), 0) ?></span>kcal</td>
				</tr>
				<tr>
					<td class="nutrient proteins">Proteins</td>
					<td><span class="value"><?= round($user->getNutrient()->getProteinsNeeds(), 0) ?></span>g</td>
				</tr>
				<tr>
					<td class="nutrient fat">Fat </td>
					<td><span class="value"><?= round($user->getNutrient()->getFatNeeds(), 0) ?></span>g</td>
				</tr>
				<tr>
					<td class="nutrient carbs">Carbs</td>
					<td><span class="value"><?= round($user->getNutrient()->getCarbsNeeds(), 0) ?></span>g</td>
				</tr>
				</tr>
			</tbody>
		</table>
		<p>
			Your daily needs have been calculated thanks to <a href="<?= Path::APP ?>/settings">your data</a>.
		</p>
	</div>

	<!--
	---- TILE 2 : TRAININGS
	-->

	<div class="tile" id="trainings">
		<table>
			<thead>
				<tr>
					<th colspan=2>🏋️‍  My trainings</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Date</td>
					<td>Shape</td>
				</tr>
				<?php
					showLastTrainings($trainings);
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan=2><a class="button" href="<?= Path::APP ?>/alltrainings">See all trainings</a></td>
					</tr>
					<tr>
						<td colspan=2><a class="button" href="addtraining">&#10012; Add a training</a></td>
					</tr>
				</tfoot>
		</table>
	</div>

	<!--
	---- TILE 3 : WEIGHT TRACKING
	-->

	<div class="tile" id="weightTracking">
		<table>
			<thead>
				<tr>
					<th colspan=2>⚖️ My Weight Tracking</th>
				</tr>
			<tbody>
				<?php displayWeights($weightTracking); ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan=2><a class="button" href="<?= Path::APP ?>/showweight">Display my whole weight tracking</a></td>
				</tr>
				<tr>
					<td colspan=2><a class="button" href="<?= Path::APP ?>/showaddweight">&#10012; Add a new weight</a></td>
				</tr>
			</tfoot>
		</table>
	</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require_once(PathView::TEMPLATE . "/template.php");
?>