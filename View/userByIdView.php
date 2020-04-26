<!-- DOCTYPE HTML -->
<?php
	use Utils\YamlHelper;

	$yamlHelper = new YamlHelper();
	$paths = $yamlHelper->getPaths();
	ob_start();
?>

<ul>
	<li>Sex : <?= $user->getSex() ?> ans</li>
	<li>Age : <?= $user->getAge() ?> ans</li>
	<li>Height : <?= $user->getHeight() ?> cm</li>
	<li>Weight : <?= $user->getWeight() ?> kg</li>
	<li>Activity : <?= $user->getActivity() ?></li>
	<li>Goal : <?= $user->getGoal() ?></li>
	<li>BMR : <?= round($user->getBmr(),0) ?> kcal</li>	
	<li>Kcal needs : <?= round($user->getKcalNeeds(),0) ?> kcal</li>	
</ul>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "template.php");
?>