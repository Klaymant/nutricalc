<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
	$today = date('yy-m-d');

	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-quarter">
		<div class="box has-text-centered">
			<h1 class="title">Your weight</h1>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>
				</tr>
			</thead>
		</table>

	</div>
</div>

<?php
	$content = ob_get_clean();
	require_once($paths['TEMPLATE'] . "template.php");
?>