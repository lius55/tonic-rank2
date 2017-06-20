$(function() {

	var showGoodsList = function(response) {
		console.log(response);
		var goodsList = [];
		response.goodsList.forEach(function(goods) {
			goods.catch_phrase = goods.catch;
			goodsList.push(goods)
		});
		response.goodsList = goodsList;
		$("#goodsRanking").empty();
		$.tmpl($("#goodsRankingTemplate"), response).appendTo("#goodsRanking");
	}

	ajax({
		url: 	apiList.rankingGoodsList,
		data: 	{
			category: 'goods_display',
			keyword:  'top'
		},
		success: showGoodsList
	});

});