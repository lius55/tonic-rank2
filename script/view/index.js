$(function() {

	var showAllGoodsList = function(response) {
		console.log(response);
		$("#goodsList").empty();
		$.tmpl($("#goodsListTemplate"), response).appendTo("#goodsList");

		for(var i=0; i < response.goodsList.length; i++) {
			if (i > 12) {
				$("#goods" + i).hide();
			}
		}
	}

	var showRankingGoodsList = function(response) {
		console.log(response);
		var goodsList = [];
		response.goodsList.forEach(function(goods) {
			goods.catch_phrase = goods.catch;
			goodsList.push(goods);
		});
		response.goodsList = goodsList;
		$("#goodsRanking").empty();
		$.tmpl($("#goodsRankingTemplate"), response).appendTo("#goodsRanking");

		if ($("#goodsList").length > 0) {
			// 商品一覧表示
			ajax({
				url: 		apiList.goodsList,
				data: 		{},
				success: 	showAllGoodsList
			});
		}
	}

	ajax({
		url: 	apiList.rankingGoodsList,
		data: 	{
			category: 'goods_display',
			keyword:  'top'
		},
		success: showRankingGoodsList
	});


	$(".andmore").on("click", function() {
		// alert("clicked");
		$(this).hide();
		$(".lineup-procuct").show();
		return false;
	});
});