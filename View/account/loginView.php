<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\PathView;
	ob_start();
?>

<div class="content">
	<form action="login" method="post">
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
		<input class="button" type="submit" value="Connection">
	</form>

	<?php
		if (isset($badLogin)) {
			echo 'Incorrect login. Try again!';
		}
	?>
	<p>
		<a class="button" href="newaccount">No account yet ? Follow this link !</a>
	</p>
	<p>
		<a class="button" href="forgottenpwdpage">Forgotten password ? Follow this link !</a>
	</p>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>