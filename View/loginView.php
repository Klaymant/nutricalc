<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<form action="index.php?account" method="post">
	<table>
		<tr>
			<td>Mail :</td>
			<td><input type="text" name="mail"></td>
		</tr>
		<tr>
			<td>Password :</td>
			<td><input type="password" name="pwd"></td>
		</tr>
	</table>
	<input type="submit" value="Connection">
</form>

<?php
	if (isset($error)) {
		echo 'Incorrect login. Try again!';
	}
?>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>