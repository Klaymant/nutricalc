<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<table>
	<thead>
		<tr>
			<td colspan=2>Date</td>
			<td>Shape</td>
		</tr>
		<tr>
			<td>Exercise</td>
			<td>Sets</td>
			<td>Reps</td>
		</tr>
		<tr>
			<td><?= $training['exercises'][0]['name'] ?></td>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>