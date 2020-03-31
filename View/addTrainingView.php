<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<form action="savetraining" method="post">
	<table>
		<tr>
			<td>Date :</td>
			<td><input type="text" name="date"></td>
			<td>Shape :</td>
			<td><input type="text" name="shape"></td>
		</tr>
	</table>
	<table>
		<tr>
			<td>Exercice 1</td>
		</tr>
		<tr>
			<td>Name :</td>
			<td><input type="text" name="exoname"></td>
			<td>Number of sets :</td>
			<td><input type="text" name="exosets"></td>
			<td>Number of reps :</td>
			<td><input type="text" name="exoreps"></td>
		</tr>
	</table>
	<input type="submit" value="Here is my new training!">
</form>

<?php
	if (isset($error)) {
		echo 'This mail is already used. Try another one!';
	}
?>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>