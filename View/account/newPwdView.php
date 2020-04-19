<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\Path;
	use Config\PathView;
	ob_start();
?>

<div class="content">
	<?php
		$formPath = Path::APP . '/changepwd';

		if (isset($pwdIdExisting) & $pwdIdExisting) {
			echo 'Hello ' . $userMail . '!';
			echo '<form action="' . $formPath . '" method="post">
				<table>
					<tr>
						<td>Your new password :</td>
						<td><input type="password" name="newPwd"></td>
					</tr>
				</table>
				<input type="hidden" name="userId" value=' . $userId . '>
				<input class="button" type="submit" value="Reset my password">
			</form>';
		}
		else {
			echo "There was an error!";
			//header("Location : " . Path::APP . "/dashboard");
		}
	?>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>