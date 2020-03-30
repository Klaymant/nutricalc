<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<div class="tile" id="data">
	<table>
		<thead>
			<tr>
				<th colspan=2>My data</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute">Sex</td>
				<td>| <span class="value"><?= $user->getSex() ?></span></td>
			</tr>
			<tr>
				<td class="attribute">Age</td>
				<td>| <span class="value"><?= $user->getAge() ?></span> years</td>
			</tr>
			<tr>
				<td class="attribute">Height</td>
				<td>| <span class="value"><?= $user->getHeight() ?></span>cm</td>
			</tr>
			<tr>
				<td class="attribute">Weight</td>
				<td>| <span class="value"><?= $user->getWeight() ?></span>kg</td>
			</tr>
			<tr>
				<td class="attribute">Activity level</td>
				<td>| <span class="value"><?= $user->getActivity() ?></span></td>
			</tr>
			<tr>
				<td class="attribute">Goal</td>
				<td>| <span class="value"><?= $user->getGoal() ?></span></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td><a href="changedata">Change my data</a></td>
			</tr>
		</tfoot>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>