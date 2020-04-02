<nav id="menu">
	<ul>
		<?php
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="http://localhost/nutricalc/index.php/app/calculator">Calculator</a></li>';
				echo '<li><a href="http://localhost/nutricalc/index.php/app/login">Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="http://localhost/nutricalc/index.php/app/dashboard">Dashboard</a></li>';
				echo '<li><a href="http://localhost/nutricalc/index.php/app/settings">Settings</a></li>';
				echo '<li><a href="http://localhost/nutricalc/index.php/app/logout">Logout</a></li>';
			}
		?>
	</ul>
</nav>