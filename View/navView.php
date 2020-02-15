<nav id="menu">
	<ul>
		<?php
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="index.php?calculator">Calculator</a></li>';
				echo '<li><a href="index.php?login">Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="index.php?dashboard">Dashboard</a></li>';
				echo '<li><a href="index.php?profile">My profile</a></li>';
				echo '<li><a href="index.php?logout">Logout</a></li>';
			}
		?>
	</ul>
</nav>