<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\PathView;
	ob_start();
?>

<div class="content">
	<form action="createaccount" method="post">
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
		<input class="button" type="submit" value="Here we go!">
	</form>

	<?php
		if (isset($error)) {
			echo 'This mail is already used. Try another one!';
		}
	?>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>