<!-- DOCTYPE HTML -->
<?php
	ob_start();
	require_once("Config/Path.php");
	use Config\Path;
	use Config\PathView;
?>

<div class="columns is-centered has-text-centered">
	<div class="column is-half">
		<div class="box">
			<h2 class="title is-3">Welcome to my amazing nutrients calculator!</h2>	
		</div>

		<div class="box">
			<div class="content">
				<p>
					It is a tool that will help you to count the amount of calories and macronutrients you need depending on your physiological characteristics, your lifestyle and your goal.
				</p>
			</div>

			<div class="content">
				<p>
					You just have to put your personal characteristics and let my calculator do the rest!</br>
					You can also create an account so that you can follow your progress!
				</p>
			</div>

			<div class="columns">
				<div class="column has-background-grey-light">
					<p>
						Can't wait to finally know what you need?</br>
						<a class="button is-small is-info" href="<?= PATH::APP ?>/calculator">I WANT TO KNOW!</a>
					</p>
				</div>

				<div class="column has-background-grey-light">
					<p>
						Not among our team yet?</br>
						<a class="button is-small is-info" href="<?= PATH::APP ?>/newaccount">JOIN US!</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>