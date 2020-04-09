function addExo () {
		document.getElementById("exercises").innerHTML +=
		"<thead>" +
			"<tr>" +
				"<th colspan=2>Exercise n°" + exoNb + "</th>" +
			"</tr>" +
		"</thead>" +
		"<tbody>" +
			"<tr>" +
				"<td class='exoField'>Name</td>" +
				"<td>" + makeSelect() + "</td>" +
			"</tr>" +
			"<tr>" +
				"<td class='exoField'>Work load (kg)</td>" +
				"<td><input size=1 type='number' min=0 value=10 name='work_load_" + exoNb + "'></td>" +
			"</tr>" +
			"<tr>" +
				"<td class='exoField'>Rest (seconds)</td>" +
				"<td><input size=1 type='number' min=10 step=10 value=60 name='rest_" + exoNb + "'></td>" +
			"</tr>" +
			"<tr>" +
				"<td class='exoField'>Number of sets</td>" +
				"<td><input size=1 type='number' min=0 max=10 step=1 value=4 name='sets_" + exoNb + "'></td>" +
			"</tr>" +
			"<tr>" +
				"<td class='exoField'>Number of reps</td>" +
				"<td><input size=1 type='number' min=0 max=100 step=1 value=10 name='reps_" + exoNb + "'></td>" +
			"</tr>" +
			"<tr>" +
				"<td class='exoField'>Method</td>" +
				"<td><input size=1 type='text' name='method_" + exoNb + "'></td>" +
			"</tr>" +
		"</tbody>";
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

function removeExo() {
}