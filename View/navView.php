<nav id="menu">
	<ul>
		<?php
			require_once("Config/Path.php");
			use Config\Path;

			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="' . PATH::APP . '/calculator"><img src="' . PATH::IMG . '/calculator_white_icon.png" />Calculator</a></li>';
				echo '<li id="login"><a href="' . PATH::APP . '/login"><img src="' . PATH::IMG . '/switch_white_icon.png" />Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="' . PATH::APP . '/dashboard"><img src="' . PATH::IMG . '/dashboard_white_icon.png" />Dashboard</a></li>';
				echo '<li><a href="' . PATH::APP . '/settings"><img src="' . PATH::IMG . '/settings_white_icon.png" />Settings</a></li>';
				echo '<li id="logout"><a href="' . PATH::APP . '/logout"><img src="' . PATH::IMG . '/switch_white_icon.png" />Logout</a></li>';
			}
		?>
	</ul>
</nav>