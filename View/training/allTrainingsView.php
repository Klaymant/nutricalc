<!-- DOCTYPE HTML -->
<?php
	ob_start();
	use Config\PathView;
	use Config\Path;

	function getActualShape($shape) {
		$actualShape = "";
		for ($iShape=0; $iShape<$shape; $iShape++) :
			$actualShape .= mb_convert_encoding('&#x1f4aa;', 'UTF-8', 'HTML-ENTITIES');
		endfor;
		return $actualShape;
	}
?>

	<?php
		$iTraining = 0;
		foreach ($trainings as $trainee) :
			$actualDate = new DateTime($trainee->getDate());
			$actualShape = getActualShape($trainee->getShape());
			if ($iTraining % 2 == 0 or $iTraining == 0) :
	?>
				<div class="columns is-centered">;
	<?php endif; ?>
			<div class="column is-two-fifths">
				<div class="box has-text-centered">
					
					<!-- Header -->
					<div class="columns">

						<!-- Date -->
						<div class="column has-text-left">
							<a class="button has-background-success has-text-white" href="<?= Path::APP ?>/training/<?= $trainee->getId() ?>">
								<?= $actualDate->format('l') ?>
							</a>
							<a class="button has-background-light" href="<?= Path::APP ?>/training/<?= $trainee->getId() ?>"><?= $trainee->getDate() ?></a>			
						</div>

						<!-- Shape -->
						<div class="column has-text-right">
							<button class="button has-background-success has-text-white">
								<?= $actualShape?>
							</button>
						</div>	
					</div>
					<!-- #END Header -->

					<!-- Exercises -->
					<table class="table is-fullwidth">
						<thead>
							<tr>
								<th>Exercise</th>
								<th class="has-text-centered">Work load</th>
								<th class="has-text-centered">Sets</th>
								<th class="has-text-centered">Reps</th>
								<th class="has-text-centered">Rest</th>
								<th class="has-text-centered">Method</th>
							</tr>
						</thead>
						<tbody>
					<?php
						foreach ($trainee->getExercises() as $exo) :
							$method = ($exo->getMethod() != NULL) ? $exo->getMethod() : "None";
					?>
							<tr>
								<td><?= $exo->getName() ?></td>
								<td class="has-text-centered"><?= $exo->getWorkLoad() ?> kg</td>
								<td class="has-text-centered"><?= $exo->getSets() ?></td>
								<td class="has-text-centered"><?= $exo->getReps() ?></td>
								<td class="has-text-centered"><?= $exo->getRest() ?>s</td>
								<td class="has-text-centered"><?= $method ?></td>
							</tr>
					<?php
						endforeach;
					?>
						</tbody>
					</table>
					<!-- #END Exercises -->

					<div class="content has-text-left">
						<a class="button is-info" href="<?= Path::APP ?>/edittraining/<?= $trainee->getId() ?>">Edit</a>
						<a class="button is-danger" href="<?= Path::APP ?>/deletetraining/<?= $trainee->getId() ?>">(-) Remove</a>
					</div>
				</div>
			</div>
		<?php
			if ($iTraining % 2 != 0) :
				echo '</div>';
			endif;
			$iTraining++;
		endforeach;
	?>				
</div>

<nav class="pagination" role="navigation" aria-label="pagination">
	<?php if ($actualPageNb != 1) : ?>
		<a class="pagination-previous" href="<?= Path::APP ?>/alltrainings/<?= $actualPageNb-1 ?>">Previous</a>
	<?php endif; ?>

	<?php if ($actualPageNb < $maxNbPages) : ?>
		<a class="pagination-next" href="<?= Path::APP ?>/alltrainings/<?= $actualPageNb+1 ?>">Next page</a>
	<?php endif; ?>

	<ul class="pagination-list">
		<?php
			for ($i=1; $i<=$maxNbPages;$i++) {
				$isCurrent = "";
				if ($i == $actualPageNb) {
					$isCurrent = "has-background-success";
				}
		?>
		<li>
			<a href="<?= Path::APP ?>/alltrainings/<?= $i ?>" class="pagination-link <?= $isCurrent ?>" aria-label="Page <?= $i ?>">
				<?= $i ?>
			</a>
		</li>
		<?php } ?>
	</ul>
</nav>

<?php
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>