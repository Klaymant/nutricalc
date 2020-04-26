<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
?>

<header>
	<a id="website_title" href="<?= $paths['APP'] ?>homepage">Nutricalc</a></br></br>
	<span id="subtitle">Far beyond nutrition!</span>
</header>