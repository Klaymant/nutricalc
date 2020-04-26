<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
	ob_start();
?>

<div class="columns is-centered">
	<div class="column is-one-fifth has-text-centered">			
		<div class="box">
			<h1 class="title has-text-centered">⚙️ My data</h1>
			<table class="table is-fullwidth">
				<tbody>
					<tr>
					<td class="attribute">Sex</td>
					<td class="has-text-right"><span class="value"><?= $user->getSex() ?></span></td>
					</tr>
					<tr>
						<td class="attribute">Age</td>
						<td class="has-text-right"><span class="value"><?= $user->getAge() ?></span> years</td>
					</tr>
					<tr>
						<td class="attribute">Height</td>
						<td class="has-text-right"><span class="value"><?= $user->getHeight() ?></span>cm</td>
					</tr>
					<tr>
						<td class="attribute">Weight</td>
						<td class="has-text-right"><span class="value"><?= $user->getWeight() ?></span>kg</td>
					</tr>
					<tr>
						<td class="attribute">Activity level</td>
						<td class="has-text-right"><span class="value"><?= $user->getActivity() ?></span></td>
					</tr>
					<tr>
						<td class="attribute">Goal</td>
						<td class="has-text-right"><span class="value"><?= $user->getGoal() ?></span></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan=2><a class="button is-info" href="changedata">Change my data</a></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>