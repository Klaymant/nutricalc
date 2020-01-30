<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<table>
	<tr>
		<td>Sex : <?= $user->getSex() ?> ans</td>
	</tr>
	<tr>
		<td>Age : <?= $user->getAge() ?> ans</td>
	</tr>
	<tr>
		<td>Height : <?= $user->getHeight() ?> cm</td>
	</tr>
	<tr>
		<td>Weight : <?= $user->getWeight() ?> kg</td>
	</tr>
	<tr>
		<td>Activity : <?= $user->getActivity() ?></td>
	</tr>
	<tr>
		<td>Goal : <?= $user->getGoal() ?></td>
	</tr>
	<tr>
		<td>BMR : <?= round($user->getBmr(),0) ?> kcal</td>	
	</tr>
	<tr>
		<td>Kcal needs : <?= round($user->getKcalNeeds(),0) ?> kcal</td>	
	</tr>
</table>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>