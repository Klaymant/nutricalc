<nav id="menu">
	<ul>
		<?php
			require_once("Config/Path.php");
			use Config\Path;
			use Config\PathAsset;

			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="' . Path::APP . '/calculator"><img src="' . PathAsset::IMG . '/calculator_icon.png" />Calculator</a></li>';
				echo '<li id="login"><a href="' . Path::APP . '/login"><img src="' . PathAsset::IMG . '/switch_icon.png" />Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="' . Path::APP . '/dashboard"><img src="' . PathAsset::IMG . '/dashboard_icon.png" />Dashboard</a></li>';
				echo '<li><a href="' . Path::APP . '/settings"><img src="' . PathAsset::IMG . '/settings_icon.png" />Settings</a></li>';
				echo '<li id="logout"><a href="' . Path::APP . '/logout"><img src="' . PathAsset::IMG . '/switch_icon.png" />Logout</a></li>';
			}
		?>
	</ul>
</nav>