<nav id="menu">
	<ul>
		<?php
			require_once("Config/Path.php");
			use Config\Path;

			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="' . PATH::KERNEL . 'app/calculator"><img src="http://localhost/nutricalc/Public/Assets/img/calculator.png" />Calculator</a></li>';
				echo '<li id="login"><a href="' . PATH::KERNEL . 'app/login"><img src="http://localhost/nutricalc/Public/Assets/img/switch_icon.png" />Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="' . PATH::KERNEL . 'app/dashboard">Dashboard</a></li>';
				echo '<li><a href="' . PATH::KERNEL . 'app/settings"><img src="http://localhost/nutricalc/Public/Assets/img/settings_icon.png" />Settings</a></li>';
				echo '<li id="logout"><a href="' . PATH::KERNEL . 'app/logout"><img src="http://localhost/nutricalc/Public/Assets/img/switch_icon.png" />Logout</a></li>';
			}
		?>
	</ul>
</nav>