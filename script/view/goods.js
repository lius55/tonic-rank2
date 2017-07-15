$(function() {

	var showGoodsList = function(response) {
		$.tmpl($("#goodsListTemplate"), response).appendTo("#goodsList");
	}

	ajax({
		url: 	apiList.goodsList,
		data: 	{},
		success: showGoodsList
	});
});