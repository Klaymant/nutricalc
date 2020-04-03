<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<script text="text/javascript">
	var exoNb = 2;
</script>

<form action="savetraining" method="post">
	<h1>New training</h1>
	<table>
		<h2>Info of the day</h2>
		<tr>
			<td>Date :</td>
			<td><input size=7 type="date" name="date"></td>
		</tr>
		<tr>
			<td>Shape :</td>
			<td><input size=1 type="number" min=0 max=10 step=1 value=5 name="shape">/10</td>
		</tr>
	</table>
	<table id="exercises">
		<h2>Exercises</h2>
		<tr>
			<h3>Exercice 1</h3>
		</tr>
		<tr>
			<td>Name :</td>
			<td>
				<select name="name_1">
					<?php
						foreach ($exoInfo as $info) {
							echo '<option value="' . $info['id'] . '">' . $info['name'] . '</option>';
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Rest :</td>
			<td><input type="text" name="rest_1"></td>
		</tr>
		<tr>
			<td>Number of sets :</td>
			<td><input size=1 type="number" min=0 max=10 step=1 value=4 name="sets_1"></td>
		</tr>
			<td>Number of reps :</td>
			<td><input size=1 type="number" min=0 max=100 step=1 value=10 name="reps_1"></td>
		<tr>
			<td>Method :</td>
			<td><input type="text" name="method_1"></td>
		</tr>
	</table>
	<input class="button" type="submit" value="Here is my new training!">
</form>

<button class="button" onclick="addExo($exoInfo)">
	+ Add another exercise
</button>

<script src="http://localhost/nutricalc/Public/Assets/js/addexo.js" type="text/javascript"></script>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>