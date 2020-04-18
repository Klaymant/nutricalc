<!-- DOCTYPE HTML -->
<?php
	require_once("Config/Path.php");
	use Config\Path;
	use Config\PathView;
	ob_start();
?>

<div class="tile" id="data">
	<table>
		<thead>
			<tr>
				<th colspan=2>⚙️ My data</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute firstCol">Sex</td>
				<td><span class="value"><?= $user->getSex() ?></span></td>
			</tr>
			<tr>
				<td class="attribute">Age</td>
				<td><span class="value"><?= $user->getAge() ?></span> years</td>
			</tr>
			<tr>
				<td class="attribute">Height</td>
				<td><span class="value"><?= $user->getHeight() ?></span>cm</td>
			</tr>
			<tr>
				<td class="attribute">Weight</td>
				<td><span class="value"><?= $user->getWeight() ?></span>kg</td>
			</tr>
			<tr>
				<td class="attribute">Activity level</td>
				<td><span class="value"><?= $user->getActivity() ?></span></td>
			</tr>
			<tr>
				<td class="attribute">Goal</td>
				<td><span class="value"><?= $user->getGoal() ?></span></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td><a class="button" href="changedata">Change my data</a></td>
			</tr>
		</tfoot>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require (PathView::TEMPLATE . "/template.php");
?>