$(function() {

	var showCompList = function(response) {
		$.tmpl($("#compListTemplate"), response).appendTo("#compList");
	}

	ajax({
		url: 	apiList.compList,
		data: 	{},
		success: showCompList
	});
});