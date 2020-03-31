<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<form action="savetraining" method="post">
	<table>
		<tr>
			<td>Date :</td>
			<td><input type="text" name="date"></td>
		</tr>
		<tr>
			<td>Shape :</td>
			<td><input type="text" name="shape"></td>
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