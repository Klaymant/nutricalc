<nav id="menu">
	<ul>
		<?php
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
				echo '<li><a href="calculator">Calculator</a></li>';
				echo '<li><a href="login">Login</a></li>';
			}
			if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
				echo '<li><a href="dashboard">Dashboard</a></li>';
				echo '<li><a href="profile">My profile</a></li>';
				echo '<li><a href="logout">Logout</a></li>';
			}
		?>
	</ul>
</nav>