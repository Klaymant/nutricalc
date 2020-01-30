<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>