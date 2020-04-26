<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
?>

<html>
	<body class="has-navbar-fixed-top">
		<?php include($paths['ELEMENT'] . "headView.php"); ?>
		<?php include($paths['ELEMENT'] . "navView.php"); ?>
		<?php echo $content; ?>
		<?php include($paths['ELEMENT'] . "footerView.php"); ?>
	</body>
</html>