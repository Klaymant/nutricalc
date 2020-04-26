<!DOCTYPE html>
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
?>

<head>
	<title>Nutricalc</title>
	<script src="https://kit.fontawesome.com/80c79252c9.js" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Roboto:wght@100;700&family=Sen:wght@400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39+Text&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
	<link rel="stylesheet" type="text/css" href="<?= $paths['CSS'] ?>style.css" />
</head>