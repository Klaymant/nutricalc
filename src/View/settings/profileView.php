<!-- DOCTYPE HTML -->
<?php
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
				<td><?= $user->getAttribute("sex") ?></td>
			</tr>
			<tr>
				<td class="attribute">Age :</td>
				<td><?= $user->getAttribute("age") ?> years</td>
			</tr>
			<tr>
				<td class="attribute">Height :</td>
				<td><?= $user->getAttribute("height") ?> cm</td>
			</tr>
			<tr>
				<td class="attribute">Weight :</td>
				<td><?= $user->getAttribute("weight") ?> kg</td>
			</tr>
			<tr>
				<td class="attribute">Activity level :</td>
				<td><?= $user->getAttribute("activity") ?></td>
			</tr>
			<tr>
				<td class="attribute">Goal :</td>
				<td><?= $user->getAttribute("goal") ?></td>
			</tr>
		</tbody>
	</table>

	<a class="button" href="changedata">Change my data</a>
</div>

<?php
	$content = ob_get_clean();
	require_once($paths['TEMPLATE'] . "template.php");
?>