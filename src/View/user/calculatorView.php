<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box">
			<h1 class="title">Serious things are coming</h1>
		</div>

		<article class="message is-info has-text-centered">
			<div class="message body">
				It is now time to give your personal characteristics so that you can estimate the calories you need to reach your goal!
			</div>
		</article>

		<?php if(isset($user)) : ?>
			<div class="box has-text-centered">
				
				<table class="table is-centered">
					<tbody>
						<tr>
							<td class="has-background-success has-text-white">Calories</td>
							<td class="has-text-right">
								<?= round($user->getAttribute("nutrient")->getAttribute("kcalNeeds"), 0) ?>kcal
							</td>
						</tr>
						<tr>
							<td class="has-background-danger has-text-white">Proteins</td>
							<td class="has-text-right">
								<?=round($user->getAttribute("nutrient")->getAttribute("proteinsNeeds"), 0) ?>g
							</td>
						</tr>
						<tr>
							<td class="has-background-warning has-text-white">Fat</td>
							<td class="has-text-right">
								<? round($user->getAttribute("nutrient")->getAttribute("fatNeeds"), 0) ?>g
							</td>
						</tr>
						<tr>
							<td class="has-background-info has-text-white">Carbs</td>
							<td class="has-text-right">
								<?= round($user->getAttribute("nutrient")->getAttribute("carbsNeeds"), 0) ?>g
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

		<div class="box">
			<form class="form" action="usercalculator" method="post">
				<div class="field">
					<label class="label">Sex</label>
					<input class="radio" type="radio" name="sex" value="F">Female
					<input class="radio" type="radio" name="sex" value="H" checked="checked">Male
				</div>

				<div class="field">
					<label class="label">Age</label>
					<input class="input" type="number" name="age" value=26>
				</div>

				<div class="field">
					<label class="label">Height</label>
					<input class="input" type="number" name="height" value=165>
				</div>
				
				<div class="field">
					<label class="label">Weight</label>
					<input class="input" type="text" name="weight" value=62>
				</div>
				
				<div class="field">
					<label class="label">Activity Level</label>
					<div class="select">
						<select name="activity">
							<option value="Any">Any (0 time a week)</option>
		  					<option value="Low">Low (1 to 2 times a week)</option>
		  					<option value="Moderate">Moderate (2 to 3 times a week)</option>
		  					<option value="High" selected>High (3 to 4 times a week)</option>
		  					<option value="Very high">Very high (4+ times a week)</option>
						</select>
					</div>
				</div>

				<div class="field">
					<label class="label">Goal</label>
					<div class="select">
						<select name="goal">
							<option value="Fat loss" selected>Fat Loss</option>
		  					<option value="Maintain">Maintain</option>
		  					<option value="Mass gain">Muscle Gain</option>
						</select>
					</div>
				</div>

				<input class="button is-info" type="submit" value="Calculate">
			</form>
		</div>
	</div>
</div>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>