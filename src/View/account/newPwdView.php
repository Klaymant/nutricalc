<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();

	ob_start();
?>

<div class="content">
	<?php
		$formPath = Path::APP . '/changepwd';

		if (isset($pwdIdExisting) && $pwdIdExisting) : ?>
			Hello <?= $userMail ?> !
			<form action="<?= $formPath ?>" method="post">
				<table>
					<tr>
						<td>Your new password :</td>
						<td><input type="password" name="newPwd"></td>
					</tr>
				</table>
				<input type="hidden" name="userId" value='<?= $userId ?>'>
				<input class="button" type="submit" value="Reset my password">
			</form>
		<?php else : ?>
			There was an error!
		<?php endif; ?>
</div>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>