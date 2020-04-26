<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper();
	$paths = $yamlHelper->getPaths();

	ob_start();
?>

<div class="columns is-centered">

	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h2 class="title is-3">Edit your data</h2>
			<p>
				You did it wrong when creating your account ? No panic! Thanks to this form you can change this!
			</p>
		</div>

		<div class="box">
			<form class="form" action="savedata" method="post">
				<div class="field">
					<div class="control">
						<label class="label">Sex</label>
						<input type="radio" name="sex" value="F">Female
						<input type="radio" name="sex" value="M" checked="checked">Male
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">Age</label>
						<input class="input" type="number" placeholder="Your age" name="age" min=16 max=120>
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">Height</label>
						<input class="input" type="number" placeholder="Your height (in cm)" min=130 max=230 name="height">
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">Weight</label>
						<input class="input" type="number" placeholder="Your weight (in kg)" min=30 max=120  name="weight">
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">Activity Level</label>
						<div class="select is-info">
							<select name="activity">
								<option value=1>Any (0 time a week)</option>
			  					<option value=2>Low (1 to 2 times a week)</option>
			  					<option value=3>Moderate (2 to 3 times a week)</option>
			  					<option value=4>High (3 to 4 times a week)</option>
			  					<option value=5>Very high (4+ times a week)</option>
								</select>
						</div>
					</div>
				</div>
				<div class="field">
					<div class="control">
						<label class="label">Goal</label>
						<div class="select is-info">
							<select name="goal">
								<option value=1>Fat Loss</option>
			  					<option value=2>Maintain</option>
			  					<option value=3>Muscle Gain</option>
								</select>
						</div>
					</div>
				</div>
				<button class="button is-info is-focused" type="submit">Save my data</button>
			</form>
		</div>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>