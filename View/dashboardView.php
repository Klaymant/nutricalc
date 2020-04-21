<!-- DOCTYPE HTML -->
<?php
	use Config\Path;
	use Config\PathView;
	ob_start();

	function displayWeights($weightTracking) {
		foreach($weightTracking as $weightData) {
			echo '
			<tr>
				<td>&#10026; ' . $weightData['wt_date'] . '</td>
				<td class="has-text-right">'. $weightData['wt_weight'] . 'kg</td>
			</tr>';
		}
	}

		function showLastTrainings($trainings) {
		foreach ($trainings as $training) {
			echo '<tr>';
			$date = '<td>&#10026; ' .
			'<a href="training/' . $training->getId() . '">' .
			$training->getDate() . '</a>' .
			'</td>';
			$shape = '<td class="has-text-right">' . $training->getShape() . '/10</td>';
			echo $date;
			echo $shape;
			echo '</tr>';
		}
	}
?>

<!-- WELCOME MESSAGE -->

<div class="message is-success has-text-centered">
	<div class="message-body">
		<p>
			Hello <span class="userName"><?= $mail['u_mail'] ?></span>!
		</p>
		<?php
			if (isset($trainings[0]))
			{
				echo "<p>&#10077; The last time you 💪 was the <strong>" . $trainings[0]->getDate() . "</strong> &#10078;</p>";
			}
		?>
	</div>
</div>

<!-- DASHBOARD TILES -->

<!-- 1. Daily Needs -->

<div class="columns is-variable is-8 is-centered">
	<div class="column is-one-quarter has-text-centered">
		<div class="box">
			<h1 class="title">🍌 My daily needs</h1>
			<table class="table is-fullwidth dashboard is-narrow">
				<tr class="nutrient calories">
					<td>Calories</td>
					<td class="has-text-right">1300kcal / <?= round($user->getNutrient()->getKcalNeeds(), 0) ?>kcal</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-success" value="50" max="80"></progress></td>
				</tr>
				<tr class="nutrient proteins">
					<td>Proteins</td>
					<td class="has-text-right">80g / <?= round($user->getNutrient()->getProteinsNeeds(), 0) ?>g</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-danger" value="50" max="80"></progress></td>
				</tr>
				<tr class="nutrient fat">
					<td>Fat </td>
					<td class="has-text-right">50g / <?= round($user->getNutrient()->getFatNeeds(), 0) ?>g</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-warning" value="50" max="80"></progress></td>
				</tr>
				<tr class="nutrient carbs">
					<td>Carbs</td>
					<td class="has-text-right">250g / <?= round($user->getNutrient()->getCarbsNeeds(), 0) ?>g</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-info" value="50" max="80"></progress></td>
				</tr>
			</table>
			<p>
				Your daily needs have been calculated thanks to <a href="<?= Path::APP ?>/settings">your data</a>.
			</p>
		</div>
	</div>

<!-- 2. Trainings -->

	<div class="column is-one-quarter has-text-centered">
		<div class="box">
			<h1 class="title">🏋️‍  My trainings</h1>
			<table class="table is-fullwidth is-striped has-content-centered is-narrow">
				<thead>
					<tr>
						<th>Date</th>
						<th class="has-text-right">Shape</th>
					</tr>
				</thead>
				<tbody>
					<?php showLastTrainings($trainings); ?>
				</tbody>
			</table>
			<a class="button is-info is-small" href="<?= Path::APP ?>/alltrainings/1">See all trainings</a>
			<a class="button is-success is-small" href="<?= Path::APP ?>/addtraining">&#10012; Add a training</a>
		</div>
	</div>

<!-- 3. Weight Tracking -->

	<div class="column is-one-quarter has-text-centered">			
		<div class="box">
			<h1 class="title">⚖️ My Weight Tracking</h1>
			<table class="table is-fullwidth is-striped dashboard is-narrow">
				<thead>
					<th>Date</th>
					<th class="has-text-right">Weight</th>
				</thead>
				<tbody>
					<?php displayWeights($weightTracking); ?>
				</tbody>
			</table>
			<a class="button is-info is-small" href="<?= Path::APP ?>/showweight">Display my whole weight tracking</a>
			<a class="button is-success is-small" href="<?= Path::APP ?>/showaddweight">&#10012; Add a new weight</a>
		</div>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require_once(PathView::TEMPLATE . "/template.php");
?>