<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<p>
	It is now time to give your personal data so that you can estimate the calories you need to reach your goal!
</p>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>