function addExo (exoInfo) {
		document.getElementById("exercises").innerHTML +=
		"<h3>Exercises " + exoNb +"</h3>" +
		"<tr>" +
			"<td>Name :</td>" +
			"<td><input type='text' name='name_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Rest :</td> <td><input type='text' name='rest_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Number of sets :</td><td><input size=1 type='number' min=0 max=10 step=1 value=4 name='sets_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Number of reps :</td><td><input size=1 type='number' min=0 max=100 step=1 value=10 name='reps_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Method :</td><td><input type='text' name='method_" + exoNb + "'></td>" +
		"</tr>";
		exoNb += 1;
	}

	function makeSelect(exoInfo) {
		var select = "<select name='" + exoNb + "'>";
		select += exoInfo.forEach();
		select += "</select>";
		return select
	}