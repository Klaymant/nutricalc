<?php
	use Utils\YamlHelper;
	$paths = YamlHelper::getPaths('path.yaml');
?>

<nav class="navbar is-fixed-top is-black" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item has-text-success" href="<?= $paths['APP'] ?>homepage">
		Nutricalc
		</a>
	</div>

	<div id="navbarBasicExample" class="navbar-menu">
		<div class="navbar-start">
			<?php
				if (isset($_SESSION['logged']) && $_SESSION['logged']) :
			?>
					<a class="navbar-item has-text-white" href="<?= $paths['APP'] ?>dashboard">
					<figure class="image is-16x16">
						<img src="<?= $paths['IMG'] ?>dashboard_white_icon.png">
					</figure>
					<p>Dashboard</p>
					</a>

					<a class="navbar-item has-text-white" href="<?= $paths['APP'] ?>settings">
					<figure class="image is-16x16">
						<img src="<?= $paths['IMG'] ?>settings_white_icon.png">
					</figure>
					<p>Settings</p>
					</a>
			<?php endif; ?>
		</div>
	</div>

	<div class="navbar-end">
		<div class="navbar-item">
			<div class="buttons">
				<?php
					if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) :
				?>
						<a class="button is-primary" href="<?= $paths['APP'] ?>loginpage" class="button is-light">
							<figure class="image is-16x16">
								<img src="<?= $paths['IMG'] ?>switch_white_icon.png">
							</figure>
							Log in
						</a>
					<?php else : ?>
						<a class="button is-danger" href="<?= $paths['APP'] ?>logout" class="button is-light">
							<figure class="image is-16x16">
								<img src="<?= $paths['IMG'] ?>switch_white_icon.png">
							</figure>
							Log out
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</nav>