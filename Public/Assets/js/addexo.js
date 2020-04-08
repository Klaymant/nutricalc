function addExo () {
		document.getElementById("exercises").innerHTML +=
		"<h3>Exercise " + exoNb + "</h3>" +
		"<tr>" +
			"<td>Name :</td>" +
			"<td>" + makeSelect() + "</td>" +
		"</tr>" +
		"<tr>" +
			"<td>Work load :</td> <td><input type='text' name='work_load_" + exoNb + "'>kg</td>" +
		"</tr>" +
		"<tr>" +
			"<td>Rest :</td> <td><input type='text' name='rest_" + exoNb + "'>seconds</td>" +
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

function makeSelect() {
	var select = '<select name="name_' + '">';
	for(i=0; i<exoInfo.length; i++) {
		select += '<option value="' + exoInfo[i]['id'] + '">' +
		exoInfo[i]["name"] +
		'</option>';
	}
	select += "</select>";
	return select;
}