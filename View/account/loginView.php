<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper();
	$paths = $yamlHelper->getPaths();

	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h2 class="title is-3">Log in</h2>
			<p>
				You are probably impatient to get into my website aren't you ?
			</p>
		</div>

		<?php if (isset($badLogin)) : ?>
				<div class="box has-background-danger has-text-white">
					Incorrect login. Try again!
				</div>
		<?php endif; ?>

		<div class="content">
			<form class="form" action="login" method="post">
				<div class="field">
					<label class="label">Email</label>
					<div class="control has-icons-right">
						<input class="input is-danger" type="email" name="mail" placeholder="myadresse@mail.com">
					</div>
					<p class="help is-danger">This email is invalid</p>
		  			<label class="label">Password</label>
		  			<div class="control">
		    			<input class="input" type="password" name="pwd" placeholder="Your password">
		  			</div>
				</div>
				<button class="button is-primary is-focused" type="submit">Connection</button>
			</form>

			<div class="buttons">
				<button class="button is-info">
					<a class="has-text-white" href="newaccount">No account yet ? Don't wait more!</a>
				</button>
				<button class="button is-info">
					<a class="has-text-white" href="forgottenpwdpage">Forgotten password ?</a>
				</button>
			</div>
		</div>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>