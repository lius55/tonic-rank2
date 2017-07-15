$(function() {

	var showGoodsList = function(response) {
		// TODO showGoodsList
	    $.tmpl($("#cosPerGoodsTemplate"), response).appendTo("#goodsCosPerList");
	};

	var showCostGoodsList = function(response) {
		// TODO showCostGoodsList
		showSpecificGoods(response, "#costRankingTemplate", "#costRanking");

		ajax({
			url:  apiList.goodsList,
			data: {},
			success: showGoodsList
		});
	};

	//------------------
	//     初期処理
	//------------------	
	ajax({
		url: 	apiList.rankingGoodsList,
		data: 	{
			category: 'goods_display',
			keyword:  'trd'
		},
		success: showCostGoodsList
	});

});