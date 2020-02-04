<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<p>
	Welcome to my nutrients calculator!
</p>

<p>
	It is a tool that will help you to count the amount of calories you need depending on your physiological caracteristics, your lifestyle and your goal.
</p>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>