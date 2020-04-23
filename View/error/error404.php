<!-- DOCTYPE HTML -->
<?php
	use Config\Path;
	use Config\PathView;
	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-half">
		<div class="box has-text-centered has-background-danger">
			<h1 class="title has-text-white">Error404!</h1>
		</div>

		<div class="box has-text-centered">
			<div class="content">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/XEngx1ghudw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>

			<div class="content">
				<h2 class="subtitle is-5">
					You have been pretty brave to adventure here but I swear there is nothing interesting hidden in this page, sorry ! </br>:-(
				</h2>
			</div>
		</div>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require_once(PathView::TEMPLATE . "/template.php");
?>