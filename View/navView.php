<nav id="menu">
	<ul>
		<?php
			require_once("Config/Path.php");
			use Config\Path;

			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="' . PATH::KERNEL . 'app/calculator">Calculator</a></li>';
				echo '<li><a href="' . PATH::KERNEL . 'app/login">Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="' . PATH::KERNEL . 'app/dashboard">Dashboard</a></li>';
				echo '<li><a href="' . PATH::KERNEL . 'app/settings">Settings</a></li>';
				echo '<li><a href="' . PATH::KERNEL . 'app/logout">Logout</a></li>';
			}
		?>
	</ul>
</nav>