<?php
	use Utils\YamlHelper;
	$paths = YamlHelper::getPaths('path.yaml');
?>

<header>
	<a id="website_title" href="<?= $paths['APP'] ?>homepage">Nutricalc</a></br></br>
	<span id="subtitle">Far beyond nutrition!</span>
</header>