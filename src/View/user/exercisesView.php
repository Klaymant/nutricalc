<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-third">
		<div class="box">
			<h1 class="title has-text-centered">Exercises List</h1>
		</div>

		<?php foreach ($exercises as $exo) : ?>
			<div class="box has-text-centered">
				<div class="columns">
					<div class="column is-one-third has-text-left">
						<ul>
							<li><h1 class="title has-background-success"><?= $exo['exo_c_name'] ?></h1></li>
							<li><h2 class="subtitle">Body parts : <?= $exo['exo_c_bodypart'] ?></h2></li>
							<li><h2 class="subtitle">Polyarticular : <?= $exo['exo_c_polyarticular'] == 0 ? 'Yes' : 'No' ?></h2></li>
						</ul>
					</div>
					<div class="column has-text-right">
						<p>
							<iframe width="350" height="250" src="<?= $exo['exo_c_video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>