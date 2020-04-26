<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper('path.yaml');
	$paths = $yamlHelper->getPaths();
	ob_start();
?>

<div class="tile" id="data">
	<table>
		<thead>
			<tr>
				<th colspan=2>Personal Data</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute">Sex :</td>
				<td><?= $user->getSex() ?></td>
			</tr>
			<tr>
				<td class="attribute">Age :</td>
				<td><?= $user->getAge() ?> years</td>
			</tr>
			<tr>
				<td class="attribute">Height :</td>
				<td><?= $user->getHeight() ?> cm</td>
			</tr>
			<tr>
				<td class="attribute">Weight :</td>
				<td><?= $user->getWeight() ?> kg</td>
			</tr>
			<tr>
				<td class="attribute">Activity level :</td>
				<td><?= $user->getActivity() ?></td>
			</tr>
			<tr>
				<td class="attribute">Goal :</td>
				<td><?= $user->getGoal() ?></td>
			</tr>
		</tbody>
	</table>

	<a class="button" href="changedata">Change my data</a>
</div>

<?php
	$content = ob_get_clean();
	require_once($paths['TEMPLATE'] . "template.php");
?>