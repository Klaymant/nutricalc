function addExo () {
	var table = document.createElement('table');
	var content = getContent();

	table.setAttribute("id", "exo_" + exoNb);
	table.setAttribute("class", "exercise");

	var removeExoId = "rmv_" + exoNb;
	var removeButton = "<input type='button' id='" + removeExoId + "' value='(-) Remove this exo' onclick='removeExo(this.id)'>";

	table.innerHTML = content + removeButton;
	document.getElementById("exercises").appendChild(table);
	exoNb += 1;
}

function displayExos () {
	var table = document.createElement('table');
	var existingContent = getExistingContent();

	table.setAttribute("id", "exo_" + exoNb);
	table.setAttribute("class", "exercise");

	var removeExoId = "rmv_" + exoNb;
	var removeButton = "<input type='button' id='" + removeExoId + "' value='(-) Remove this exo' onclick='removeExo(this.id)'>";

	table.innerHTML = existingContent + removeButton;
	document.getElementById("exercises").appendChild(table);
	exoNb += 1;
}

function getExistingContent() {
	var existingContent =
	"<tbody>" +
		"<tr>" +
			"<td class='exoField'>Name</td>" +
			"<td>" + exoExistingSelect() + "</td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Work load (kg)</td>" +
			"<td><input size=1 type='number' min=0 value=" + exercises[exoNb-1]['workLoad'] + " name='workload_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Rest (seconds)</td>" +
			"<td><input size=1 type='number' min=10 step=10 value=" + exercises[exoNb-1]['rest'] + " name='rest_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Number of sets</td>" +
			"<td><input size=1 type='number' min=0 max=10 step=1 value=" + exercises[exoNb-1]['nbSets'] + " name='sets_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Number of reps</td>" +
			"<td><input size=1 type='number' min=0 max=100 step=1 value=" + exercises[exoNb-1]['nbReps'] + " name='reps_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Method</td>" +
			"<td>" + methodExistingSelect() + "</td>" +
		"</tr>" +
	"</tbody>";
	return existingContent;
}

function exoExistingSelect() {
	var actualExoName = exercises[exoNb-1]['exoName'];
	var select = '<select name="name_' + exoNb + '">';

	for (i=0; i<exoInfo.length; i++) {
		var selected = '';
		if (actualExoName == exoInfo[i]['exo_c_name']) {
			selected = ' selected';
		};
		select += '<option value="' + exoInfo[i]['exo_c_id'] + '"' + selected +'>' +
		exoInfo[i]["exo_c_name"] +

		'</option>';
	}
	select += "</select>";
	return select;
}

function methodExistingSelect() {
	var thatMethodName = exercises[exoNb-1]['method']
	var select = '<select name="method_' + exoNb + '">';

	for (i=0; i<methodInfo.length; i++) {
		var selected = '';
		if (thatMethodName == methodInfo[i]['m_name']) {
			selected = ' selected';
		};
		select += '<option value="' + methodInfo[i]['m_id'] + '"' + selected +'>' +
		methodInfo[i]["m_name"] +
		'</option>';
	}
	select += "</select>";
	return select;
}

function getContent() {
	var content =
	"<tbody>" +
		"<tr>" +
			"<td class='exoField'>Name</td>" +
			"<td>" + exoSelect() + "</td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Work load (kg)</td>" +
			"<td><input size=1 type='number' min=0 value=10 name='workload_" + exoNb + "'></td>" +
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
			"<td>" + methodSelect() + "</td>" +
		"</tr>" +
	"</tbody>";
	return content;
}

function exoSelect() {
	var select = '<select name="exoName_' + exoNb + '">';
	for(i=0; i<exoInfo.length; i++) {
		select += '<option value="' + exoInfo[i]['exo_c_id'] + '">' +
		exoInfo[i]["exo_c_name"] +
		'</option>';
	}
	select += "</select>";
	return select;
}

function methodSelect() {
	var select = '<select name="method_' + exoNb + '">';
	for(i=0; i<methodInfo.length; i++) {
		select += '<option value="' + methodInfo[i]['m_id'] + '">' +
		methodInfo[i]["m_name"] +
		'</option>';
	}
	select += "</select>";
	return select;
}

function removeExo(exoId) {
	var actualExoNb = exoId.slice(4);
	var exoToRmv = document.getElementById("exo_" + actualExoNb);
	var exoContainer = document.getElementById("exercises");
	exoContainer.removeChild(exoToRmv);
}