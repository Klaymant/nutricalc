<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<p>
	It is now time to give your personal data so that you can estimate the calories you need to reach your goal!
</p>

<form action="index.php?usercalculator" method="post">
	<table>
		<tr>
			<td>Sex :</td>
			<td>
				<input type="radio" name="sex" value="F">Female
				<input type="radio" name="sex" value="H">Male
			</td>
		</tr>
		<tr>
			<td>Age :</td>
			<td><input type="text" name="age"></td>
		</tr>
		<tr>
			<td>Height :</td>
			<td><input type="text" name="height"></td>
		</tr>
		<tr>
			<td>Weight :</td>
			<td><input type="text" name="weight"></td>
		</tr>
		<tr>
			<td>Activity level :</td>
			<td>
				<select name="activity">
					<option value="Any">Any (0 time a week)</option>
  					<option value="Low">Low (1 to 2 times a week)</option>
  					<option value="Moderate">Moderate (2 to 3 times a week)</option>
  					<option value="High">High (3 to 4 times a week)</option>
  					<option value="Very high">Very high (4+ times a week)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Goal :</td>
			<td>
				<select name="goal">
					<option value="Fat loss">Fat Loss</option>
  					<option value="Maintain">Maintain</option>
  					<option value="Mass gain">Muscle Gain</option>
				</select>
			</td>
		</tr>
	</table>
	<input type="submit" value="Calculate">
</form>

<div id="needs">
	<table>
		<thead>
			<tr>
				<th colspan=2>Needs</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute">Calories |</td>
				<td>
					<?php
						if (isset($user)) {
							echo $user->getNutrient()->getKcalNeeds() . 'kcal';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="attribute">Proteins |</td>
				<td>
					<?php
						if (isset($user)) {
							echo round($user->getNutrient()->getProteins(), 0) . 'g';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="attribute">Fat |</td>
				<td>
					<?php
						if (isset($user)) {
							echo round($user->getNutrient()->getFat(), 0) . 'g';
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="attribute">Carbs |</td>
				<td>
					<?php
						if (isset($user)) {
							echo round($user->getNutrient()->getCarbs(), 0) . 'g';
						}
					?>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>