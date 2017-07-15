$(function() {

	// 口コミ表示
	var showAssessList = function(response) {
		$.tmpl($("#goodsAssessListTemplate"), response).appendTo("#goodsAssessList");

		for(var i=0; i < response.goodsList.length; i++) {
			if (i>5) {
				$("#goods" + response.goodsList[i].id).hide();
			}
		}
	}

	var showStoreGoodsList = function(response) {
	    showSpecificGoods(response, "#storeRankingTemplate", "#storeRanking");

		ajax({
			url: 	apiList.goodsList,
			data: 	{
				category: 'goods_display',
				keyword:  'sed-2'
			},
			success: showAssessList
		});
	};

	var showInternetGoodsList = function(response) {
		showSpecificGoods(response, "#internetRankingTemplate", "#internetRanking");

		ajax({
			url: 	apiList.rankingGoodsList,
			data: 	{
				category: 'goods_display',
				keyword:  'sed-2'
			},
			success: showStoreGoodsList
		});
	};

	$(".andmore").on("click", function() {
		$(this).hide();
		$(".popularity-data-list").show();
		return false;
	});

	//------------------
	//     初期処理
	//------------------	
	ajax({
		url: 	apiList.rankingGoodsList,
		data: 	{
			category: 'goods_display',
			keyword:  'sed-1'
		},
		success: showInternetGoodsList
	});

});