<?php
	require_once("Config/Path.php");
	use Config\PathView;
?>

<html>
	<body>
		<?php include(PathView::ELEMENT . "/headView.php"); ?>
		<?php include(PathView::ELEMENT . "/headerView.php"); ?>
		<?php include(PathView::ELEMENT . "/navView.php"); ?>
		<?php echo $content; ?>
		<?php include(PathView::ELEMENT . "/footerView.php"); ?>
	</body>
</html>