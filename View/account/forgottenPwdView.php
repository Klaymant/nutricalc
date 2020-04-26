<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();

	ob_start();
?>

<div class="content">
	<form action="forgottenpwd" method="post">
		<table>
			<tr>
				<td>Mail :</td>
				<td><input type="text" name="mail"></td>
			</tr>
		</table>
		<input class="button" type="submit" value="Reset my password">
	</form>
</div>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>