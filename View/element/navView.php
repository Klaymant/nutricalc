<?php
	use Config\Path;
	use Config\PathAsset;
?>

<nav class="navbar is-fixed-top is-black" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item has-text-success" href="<?= Path::APP ?>/homepage">
		Nutricalc
		</a>
	</div>

	<div id="navbarBasicExample" class="navbar-menu">
		<div class="navbar-start">
			<?php
				if (isset($_SESSION['logged']) && $_SESSION['logged']) {
					echo '
					<a class="navbar-item has-text-white" href="' . Path::APP . '/dashboard">
					<figure class="image is-16x16">
						<img src="' . PathAsset::IMG . '/dashboard_white_icon.png">
					</figure>
					<p>Dashboard</p>
					</a>

					<a class="navbar-item has-text-white" href="' . Path::APP . '/settings">
					<figure class="image is-16x16">
						<img src="' . PathAsset::IMG . '/settings_white_icon.png">
					</figure>
					<p>Settings</p>
					</a>';
				}
			?>
		</div>
	</div>

	<div class="navbar-end">
		<div class="navbar-item">
			<div class="buttons">
				<?php
					if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
						echo '
						<a class="button is-primary" href="' . Path::APP . '/loginpage" class="button is-light">
							<figure class="image is-16x16">
								<img src="' . PathAsset::IMG . '/switch_white_icon.png">
							</figure>
							Log in
						</a>';
					}
					else {
						echo '
						<a class="button is-danger" href="' . Path::APP . '/logout" class="button is-light">
							<figure class="image is-16x16">
								<img src="' . PathAsset::IMG . '/switch_white_icon.png">
							</figure>
							Log out
						</a>';
					}
				?>
				</div>
			</div>
		</div>
	</div>
</nav>

<!-- <nav id="menu">
	<ul>
		<?php
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="' . Path::APP . '/calculator"><img src="' . PathAsset::IMG . '/calculator_icon.png" />Calculator</a></li>';
				echo '<li id="login"><a href="' . Path::APP . '/loginpage"><img src="' . PathAsset::IMG . '/switch_icon.png" />Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="' . Path::APP . '/dashboard"><img src="' . PathAsset::IMG . '/dashboard_icon.png" />Dashboard</a></li>';
				echo '<li><a href="' . Path::APP . '/settings"><img src="' . PathAsset::IMG . '/settings_icon.png" />Settings</a></li>';
				echo '<li id="logout"><a href="' . Path::APP . '/logout"><img src="' . PathAsset::IMG . '/switch_icon.png" />Logout</a></li>';
			}
		?>
	</ul>
</nav> -->