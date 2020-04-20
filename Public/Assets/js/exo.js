function addExo () {
	var table = document.createElement('table');
	var title = document.createElement('h1');
	title.setAttribute("id", "title_" + exoNb);
	title.setAttribute("class", "title");
	title.setAttribute("class", "has-text-centered");
	title.innerHTML = "Exercise";

	var content = getContent();

	table.setAttribute("id", "exo_" + exoNb);
	table.setAttribute("class", "table");

	var removeExoId = "rmv_" + exoNb;
	var removeButton = "<input class='button is-danger' type='button' id='" + removeExoId + "' value='(-) Remove this exo' onclick='removeExo(this.id)'>";

	table.innerHTML = content + removeButton;
	document.getElementById("exercises").appendChild(title);
	document.getElementById("exercises").appendChild(table);
	exoNb += 1;
}

function displayExos () {
	var table = document.createElement('table');
	var title = document.createElement('h1');
	title.setAttribute("id", "title_" + exoNb);
	title.setAttribute("class", "title");
	title.setAttribute("class", "has-text-centered");
	title.innerHTML = "Exercise";

	var existingContent = getExistingContent();

	table.setAttribute("id", "exo_" + exoNb);
	table.setAttribute("class", "table");

	var removeExoId = "rmv_" + exoNb;
	var removeButton = "<input class='button is-danger' type='button' id='" + removeExoId + "' value='(-) Remove this exo' onclick='removeExo(this.id)'>";

	table.innerHTML = existingContent + removeButton;
	document.getElementById("exercises").appendChild(title);
	document.getElementById("exercises").appendChild(table);
	exoNb += 1;
}

function getExistingContent() {
	var existingContent =
	"<tbody>" +
		"<tr>" +
			"<td>Name</td>" +
			"<td>" + exoExistingSelect() + "</td>" +
		"</tr>" +
		"<tr>" +
			"<td>Work load (kg)</td>" +
			"<td>" +
				"<input class='input' type='number' min=0 value=" + exercises[exoNb-1]['workLoad'] + " name='workload_" + exoNb + "'>" +
			"</td>" +
		"</tr>" +
		"<tr>" +
			"<td>Rest (seconds)</td>" +
			"<td><input class='input' type='number' min=10 step=10 value=" + exercises[exoNb-1]['rest'] + " name='rest_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Number of sets</td>" +
			"<td><input class='input' type='number' min=0 max=10 step=1 value=" + exercises[exoNb-1]['nbSets'] + " name='sets_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Number of reps</td>" +
			"<td><input class='input' type='number' min=0 max=100 step=1 value=" + exercises[exoNb-1]['nbReps'] + " name='reps_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Method</td>" +
			"<td>" + methodExistingSelect() + "</td>" +
		"</tr>" +
	"</tbody>";
	return existingContent;
}

function exoExistingSelect() {
	var actualExoName = exercises[exoNb-1]['exoName'];
	var select = '<div class="select is-info">';
	select += '<select name="name_' + exoNb + '">';

	for (i=0; i<exoInfo.length; i++) {
		var selected = '';
		if (actualExoName == exoInfo[i]['exo_c_name']) {
			selected = ' selected';
		};
		select += '<option value="' + exoInfo[i]['exo_c_id'] + '"' + selected +'>' +
		exoInfo[i]["exo_c_name"] +

		'</option>';
	}
	select += '</select>';
	select += '</div>';
	return select;
}

function methodExistingSelect() {
	var thatMethodName = exercises[exoNb-1]['method'];
	var select = '<div class="select is-info">';
	select += '<select name="method_' + exoNb + '">';

	for (i=0; i<methodInfo.length; i++) {
		var selected = '';
		if (thatMethodName == methodInfo[i]['m_name']) {
			selected = ' selected';
		};
		select += '<option value="' + methodInfo[i]['m_id'] + '"' + selected +'>' +
		methodInfo[i]["m_name"] +
		'</option>';
	}
	select += '</select>';
	select += '</div>';
	return select;
}

function getContent() {
	var content =
	"<tbody>" +
		"<tr>" +
			"<td>Name</td>" +
			"<td>" + exoSelect() + "</td>" +
		"</tr>" +
		"<tr>" +
			"<td>Work load (kg)</td>" +
			"<td><input class='input' type='number' min=0 value=50 name='workload_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Rest (seconds)</td>" +
			"<td><input class='input' type='number' min=10 step=10 value=120 name='rest_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Number of sets</td>" +
			"<td><input class='input' type='number' min=0 max=10 step=1 value=4 name='sets_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td>Number of reps</td>" +
			"<td><input class='input' type='number' min=0 max=100 step=1 value=15 name='reps_" + exoNb + "'></td>" +
		"</tr>" +
		"<tr>" +
			"<td class='exoField'>Method</td>" +
			"<td>" + methodSelect() + "</td>" +
		"</tr>" +
	"</tbody>";
	return content;
}

function exoSelect() {
	var select = '<div class="select is-info">';
	select += '<select name="exoName_' + exoNb + '">';
	for(i=0; i<exoInfo.length; i++) {
		select += '<option value="' + exoInfo[i]['exo_c_id'] + '">' +
		exoInfo[i]["exo_c_name"] +
		'</option>';
	}
	select += '</select>';
	select += '</div>';
	return select;
}

function methodSelect() {
	var select = '<div class="select is-info">';
	select += '<select name="method_' + exoNb + '">';
	for(i=0; i<methodInfo.length; i++) {
		select += '<option value="' + methodInfo[i]['m_id'] + '">' +
		methodInfo[i]["m_name"] +
		'</option>';
	}
	select += '</select>';
	select += '</div>';
	return select;
}

function removeExo(exoId) {
	var actualExoNb = exoId.slice(4);
	var exoToRmv = document.getElementById("exo_" + actualExoNb);
	var titleToRmv = document.getElementById("title_" + actualExoNb);
	var exoContainer = document.getElementById("exercises");
	exoContainer.removeChild(exoToRmv);
	titleToRmv.remove();
}