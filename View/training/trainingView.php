<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();

	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-quarter has-text-centered">
		<div class="box">
			<h1 class="title">Training of the</h1>
			<h1 class="subtitle"><?= $training->getAttribute("date") ?></h1>
			<h1 class="subtitle">Shape : <?= $training->getAttribute("shape") ?>/10</h1>
		</div>
		<table class="table is-fullwidth has-text-centered">
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
				<tbody>
				<?php
					foreach ($training->getAttribute("exercises") as $exo) :
						$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
				?>
						<tr>
							<td><?= $exo->getName() ?></td>
							<td><?= $exo->getWorkLoad() ?>kg</td>
							<td><?= $exo->getSets() ?></td>
							<td><?= $exo->getReps() ?></td>
							<td><?= $exo->getRest() ?>s</td>
							<td><?= $method ?></td>
						</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<a class="button is-info" href="<?= $paths['APP'] ?>edittraining/<?= $training->getAttribute('id') ?>">Edit</a>
		<a class="button is-danger" href="<?= $paths['APP'] ?>deletetraining/<?= $training->getAttribute('id') ?>">❌ Delete this training</a>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>