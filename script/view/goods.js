$(function() {

	var showGoodsList = function(response) {
		$.tmpl($("#goodsListTemplate"), response).appendTo("#goodsList");

		$("#footerGoodsList").empty();
		$.tmpl($("#footerGoodsListTemplate"), response).appendTo("#footerGoodsList");
	}

	ajax({
		url: 	apiList.goodsList,
		data: 	{},
		success: showGoodsList
	});
});