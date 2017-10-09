$(function() {

	var showAllGoodsList = function(response) {
		console.log(response);

		$("#footerGoodsList").empty();
		$.tmpl($("#footerGoodsListTemplate"), response).appendTo("#footerGoodsList");
	}

	var showCompList = function(response) {
		$.tmpl($("#compListTemplate"), response).appendTo("#compList");

	    // 商品一覧表示
		ajax({
			url: 		apiList.goodsList,
			data: 		{},
			success: 	showAllGoodsList
		});
	}

	ajax({
		url: 	apiList.compList,
		data: 	{},
		success: showCompList
	});
});