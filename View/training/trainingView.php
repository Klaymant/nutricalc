<!-- DOCTYPE HTML -->
<?php
	ob_start();
	require_once("Config/Path.php");
	use Config\Path;
	use Config\PathView;
?>

<div class="columns is-centered">
	<div class="column is-one-quarter has-text-centered">
		<div class="box">
			<h1 class="title">Training of the</h1>
			<h1 class="subtitle"><?= $training->getDate() ?></h1>
			<h1 class="subtitle">Shape : <?= $training->getShape() ?>/10</h1>
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
					foreach ($training->getExercises() as $exo) {
						$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
						echo '<tr>' .
							'<td>' . $exo->getName() . '</td>' .
							'<td>' . $exo->getWorkLoad() . 'kg</td>' .
							'<td>' . $exo->getSets() . '</td>' .
							'<td>' . $exo->getReps() . '</td>' .
							'<td>' . $exo->getRest() . 's</td>' .
							'<td>' . $method . '</td>' .
						'</tr>';
					}
				?>
			</tbody>
		</table>

		<a class="button is-info" href="<?= Path::APP ?>/edittraining/<?= $training->getId() ?>">Edit</a>
		<a class="button is-danger" href="<?= Path::APP ?>/deletetraining/<?= $training->getId() ?>">❌ Delete this training</a>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>