<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<p>
	Welcome!
</p>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>