<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<h1><?= $gif->getTitle() ?></h1>
<img src="<?= $gif->getLink() ?>" />
<p>
	<?= $gif->getCategory() ?>
</p>
<p>
	<?php foreach($gif->getTags() as $tag) {
		echo $tag . "</br>";
	}
	?>
</p>

<?php
	$content = ob_get_clean();
	require ("template.php");
?>