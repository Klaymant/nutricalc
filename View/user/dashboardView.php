<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
	ob_start();
?>

<?php
	function displayWeights($weightTracking, $paths) {
		$size = count($weightTracking);
		$lastIndex = $size-1;

		for ($i=0; $i<$size; $i++) :
			$currentWeight = $weightTracking[$i]['wt_weight'];
			$currentId = $weightTracking[$i]['wt_id'];
			$nextIndex = ($i < $lastIndex) ? $i + 1 : $lastIndex;
			$weightDiff = ($i < $lastIndex) ? $currentWeight - $weightTracking[$nextIndex]['wt_weight'] : '-';
			$color = ($weightDiff < 0) ? 'has-text-success' : 'has-text-danger';
?>
			<tr>
				<td><?= $weightTracking[$i]['wt_date'] ?></td>
				<td class="has-text-centered"><?= $currentWeight ?>kg</td>
				<?php if ($i < $lastIndex) : ?>
					<td class="has-text-centered <?= $color ?>"><?= $weightDiff ?>kg</td>
				<?php else : ?>
					<td class="has-text-centered"><?= $weightDiff ?></td>
				<?php endif; ?>
				<td><a class="button is-danger is-small is-outlined" href="<?= $paths['APP'] ?>removeweight/<?= $currentId ?>">X</a></td>
			</tr>
<?php
		endfor; }
?>


<?php
		function showLastTrainings($trainings) {
			foreach ($trainings as $training) :
?>
			<tr>
				<td>
					<a href="training/<?= $training->getAttribute('id') ?>"><?= $training->getAttribute("date") ?></a>
				</td>
				<td class="has-text-right">
					<?= $training->getAttribute("shape") ?>/10
				</td>
			</tr>
<?php
			endforeach;  }
?>

<!-- WELCOME MESSAGE -->

<div class="message is-success has-text-centered">
	<div class="message-body">
		<p>Hello <span class="userName"><?= $mail['u_mail'] ?></span>!</p>
		<?php if (isset($trainings[0])) : ?>
				<p>&#10077; The last time you 💪 was the <strong><?= $trainings[0]->getAttribute("date") ?></strong> &#10078;</p>
		<?php endif; ?>
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
					<td class="has-text-right">1300kcal / <?= round($user->getAttribute("nutrient")->getAttribute("kcalNeeds"), 0) ?>kcal</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-success" value="50" max="80"></progress></td>
				</tr>
				<tr class="nutrient proteins">
					<td>Proteins</td>
					<td class="has-text-right">80g / <?= round($user->getAttribute("nutrient")->getAttribute("proteinsNeeds"), 0) ?>g</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-danger" value="50" max="80"></progress></td>
				</tr>
				<tr class="nutrient fat">
					<td>Fat </td>
					<td class="has-text-right">50g / <?= round($user->getAttribute("nutrient")->getAttribute("fatNeeds"), 0) ?>g</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-warning" value="50" max="80"></progress></td>
				</tr>
				<tr class="nutrient carbs">
					<td>Carbs</td>
					<td class="has-text-right">250g / <?= round($user->getAttribute("nutrient")->getAttribute("carbsNeeds"), 0) ?>g</td>
				</tr>
				<tr>
					<td colspan=2><progress class="progress is-info" value="50" max="80"></progress></td>
				</tr>
			</table>
			<p>
				Your daily needs have been calculated thanks to <a href="<?= $paths['APP'] ?>settings">your data</a>.
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
			<a class="button is-info is-small" href="<?= $paths['APP'] ?>alltrainings/1">See all</a>
			<a class="button is-success is-small" href="<?= $paths['APP'] ?>addtraining">&#10012;</a>
		</div>
	</div>

<!-- 3. Weight Tracking -->

	<div class="column is-one-quarter has-text-centered">			
		<div class="box">
			<h1 class="title">⚖️ My Weight Tracking</h1>
			<table class="table is-fullwidth is-striped dashboard is-narrow">
				<thead>
					<th>Date</th>
					<th class="has-text-centered">Weight</th>
					<th class="has-text-centered">Difference</th>
					<th></th>
				</thead>
				<tbody>
					<?php displayWeights($weightTracking, $paths); ?>
				</tbody>
			</table>
			<a class="button is-info is-small" href="<?= $paths['APP'] ?>showweight">See all</a>
			<a class="button is-success is-small" href="<?= $paths['APP'] ?>showaddweight">&#10012;</a>
		</div>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require_once($paths['TEMPLATE'] . "/template.php");
?>