<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\PathView;
	ob_start();
?>

<div class="content">
	<p>
		It is now time to give your personal data so that you can estimate the calories you need to reach your goal!
	</p>

	<form action="savedata" method="post">
		<table>
			<tr>
				<td>Sex :</td>
				<td>
					<input type="radio" name="sex" value="F">Female
					<input type="radio" name="sex" value="M" checked="checked">Male
				</td>
			</tr>
			<tr>
				<td>Age :</td>
				<td><input type="text" name="age"></td>
				<td>years old</td>
			</tr>
			<tr>
				<td>Height :</td>
				<td><input type="text" name="height"></td>
				<td>cm</td>
			</tr>
			<tr>
				<td>Weight :</td>
				<td><input type="text" name="weight"></td>
				<td>kg</td>
			</tr>
			<tr>
				<td>Activity level :</td>
				<td>
					<select name="activity">
						<option value=1>Any (0 time a week)</option>
	  					<option value=2>Low (1 to 2 times a week)</option>
	  					<option value=3>Moderate (2 to 3 times a week)</option>
	  					<option value=4>High (3 to 4 times a week)</option>
	  					<option value=5>Very high (4+ times a week)</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Goal :</td>
				<td>
					<select name="goal">
						<option value=1>Fat Loss</option>
	  					<option value=2>Maintain</option>
	  					<option value=3>Muscle Gain</option>
					</select>
				</td>
			</tr>
		</table>
		<input class="button" type="submit" value="Save my data">
	</form>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>