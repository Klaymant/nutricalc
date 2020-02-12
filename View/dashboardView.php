<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<!-- <div id="data">
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
</div> -->

<div id="needs">
	<table>
		<thead>
			<tr>
				<th colspan=2>Needs</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="attribute">Calories :</td>
				<td><?= round($user->getNutrient()->getKcalNeeds(), 0) ?> kcal</td>
			</tr>
			<tr>
				<td class="attribute">Proteins :</td>
				<td><?= round($user->getNutrient()->getProteins(), 0) ?> g</td>
			</tr>
			<tr>
				<td class="attribute">Fat :</td>
				<td><?= round($user->getNutrient()->getFat(), 0) ?> g</td>
			</tr>
			<tr>
				<td class="attribute">Carbs :</td>
				<td><?= round($user->getNutrient()->getCarbs(), 0) ?> g</td>
			</tr>
		</tbody>
	</table>
</div>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>