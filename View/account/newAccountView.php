<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\PathView;
	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h1 class="title">Join our team, fellow!</h1>
			<p>
				You will be able to follow your progress. How awesome it is!
			</p>
		</div>

		<div class="box">
			<form class="form" action="createaccount" method="post">
				<div class="field">
					<label class="label">Mail</label>
					<input class="input" type="mail" placeholder="address@mail.com" name="mail">
				</div>

				<div class="field">
					<label class="label">Password</label>
					<input class="input" type="password" name="pwd">
				</div>
				<input class="button is-info" type="submit" value="Here we go!">
			</form>

			<?php
				if (isset($error)) {
					echo 'This mail is already used. Try another one!';
				}
			?>
		</div>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>