<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<div class="content">
	<p>
		Welcome to my amazing nutrients calculator!
	</p>

	<p>
		It is a tool that will help you to count the amount of calories and macronutrients you need depending on your physiological caracteristics, your lifestyle and your goal.
	</p>

	<p>
		You just have to put your personal data and let my calculator do the rest!</br>
		You can also create an account so that you can follow your progress!
	</p>

	<p>
		Ready to finally know what you need ?</br>
		It's <a href="calculator">THIS WAY!</a>
	</p>

	<p>
		Want to create an account ?</br>
		It's <a href="newaccount">THIS WAY!</a>
	</p>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>