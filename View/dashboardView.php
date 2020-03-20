<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<div id="needs">
	<table>
		<thead>
			<tr>
				<th colspan=2>Needs</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute">Calories </td>
				<td>| <?= round($user->getNutrient()->getKcalNeeds(), 0) ?> kcal</td>
			</tr>
			<tr>
				<td class="attribute">Proteins </td>
				<td>| <?= round($user->getNutrient()->getProteinsNeeds(), 0) ?> g</td>
			</tr>
			<tr>
				<td class="attribute">Fat </td>
				<td>| <?= round($user->getNutrient()->getFatNeeds(), 0) ?> g</td>
			</tr>
			<tr>
				<td class="attribute">Carbs </td>
				<td>| <?= round($user->getNutrient()->getCarbsNeeds(), 0) ?> g</td>
			</tr>
		</tbody>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>