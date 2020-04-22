<!-- DOCTYPE HTML -->
<?php
	ob_start();
	date_default_timezone_set('Europe/paris');
	$today = date('yy-m-d');
	require_once("Config/Path.php");
	use Config\PathView;
?>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h1 class="title">New weight for a new life</h1>
		</div>

		<?php if (isset($weightDateExists) && $weightDateExists) : ?>
			<div class="box has-background-danger has-text-white has-text-centered">
				<p>You already weighed this day!</p>
				</br>
				<p>Weighing twice a day seems to be a bit exagerated, nope? 😮</p>
			</div>
		<?php endif; ?>

		<form class="form" action="addweight" method="post">
			<div class="field">
				<label class="label">Date</label>
				<input class="input" type="date" name="date" value="<?= $today ?>">
			</div>

			<div class="field">
				<label class="label">Weight</label>
				<input class="input" type="number" min=40 max=150 step=1 value=60 name="weight">
			</div>

			<input class="button is-info" type="submit" value="Here is my new weight!">
		</form>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require_once(PathView::TEMPLATE . "/template.php");
?>