<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\PathView;
	ob_start();
?>

<div class="content">
	<form action="changePwd" method="post">
		<table>
			<tr>
				<td>Your new password :</td>
				<td><input type="password" name="newPwd"></td>
			</tr>
		</table>
		<input class="button" type="submit" value="Reset my password">
	</form>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>