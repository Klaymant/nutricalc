<?php
	ob_start();
?>

<table class="gif">
	<?php
		foreach($gif as $g) {
			echo '<h3>'
			. '<a href="indexGif.php?id=' . $g->getId() . '">'
			. $g->getTitle()
			. '</a>'
			. '</h3>';
			echo '</br>';
			echo '<img src=' . '"' . $g->getLink() . '"' . '/>';
			echo '</br>';
		}
	?>
</table>

<?php
	$content = ob_get_clean();
	require ("template.php");
?>
