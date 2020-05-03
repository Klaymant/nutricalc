<?php
	use Utils\YamlHelper;
	$paths = YamlHelper::getPaths('path.yaml');
?>

<html>
	<body class="has-navbar-fixed-top">
		<?php include($paths['ELEMENT'] . "headView.php"); ?>
		<?php include($paths['ELEMENT'] . "navView.php"); ?>
		<?php echo $content; ?>
		<?php include($paths['ELEMENT'] . "footerView.php"); ?>
	</body>
</html>