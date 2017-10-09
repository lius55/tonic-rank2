$(function() {

	var showGoodsList = function(response) {

	    $.tmpl($("#effectGoodsTemplate"), response).appendTo("#goodsEffectList");

		$("#footerGoodsList").empty();
		$.tmpl($("#footerGoodsListTemplate"), response).appendTo("#footerGoodsList");

		ajax({
			url:  apiList.goodsCompList,
			data: {},
			success: showGoodsCompList
		});

		response.goodsList.forEach(function(goods){
			var data = {
		        labels: ["男性ホルモン抑制", "血行促進", "毛母細胞活性化", "バルジ活性化", "成長促進"],
		        datasets: [
		            {
		                backgroundColor: "rgba(253, 231, 30, 1)",
		                fillColor: "rgba(200,0,0,0.2)",
		                strokeColor: "green",
		                pointColor: "green",
		                pointStrokeColor: "green",
		                pointHighlightFill: "green",
		                pointHighlightStroke: "green",
		                data: [
		                	parseInt(goods.hormone_suppress), 
		                	parseInt(goods.circulation_prompt), 
		                	parseInt(goods.cell_activation), 
		                	parseInt(goods.bulge_activation), 
		                	parseInt(goods.growth_prompt)
		                ]
		            }
		        ]
		    };

		    var id = "effect_radar" + goods.id;
		    var ctx = document.getElementById(id).getContext("2d");
		    var radarChart = new Chart(ctx).Radar(data);
		});
	};

	var showCostGoodsList = function(response) {

		showSpecificGoods(response, "#effectRankingTemplate", "#effectRanking");

		ajax({
			url:  apiList.goodsList,
			data: {},
			success: showGoodsList
		});

		response.goodsList.forEach(function(goods){
			console.log("id=" + goods.id);
			var data = {
		        labels: ["男性ホルモン抑制", "血行促進", "毛母細胞活性化", "バルジ活性化", "成長促進"],
		        datasets: [
		            {
		                backgroundColor: "rgba(253, 231, 30, 1)",
		                fillColor: "rgba(200,0,0,0.2)",
		                strokeColor: "green",
		                pointColor: "green",
		                pointStrokeColor: "green",
		                pointHighlightFill: "green",
		                pointHighlightStroke: "green",
		                data: [
		                	parseInt(goods.hormone_suppress), 
		                	parseInt(goods.circulation_prompt), 
		                	parseInt(goods.cell_activation), 
		                	parseInt(goods.bulge_activation), 
		                	parseInt(goods.growth_prompt)
		                ]
		            }
		        ]
		    };

		    var id = "rank_radar" + goods.id;
		    var ctx = document.getElementById(id).getContext("2d");
		    var radarChart = new Chart(ctx).Radar(data);
		});
	};

	var propertyList = [
		"cell_activation"
	];

	var showGoodsCompList = function(response) {
		for (i=0; i < response.goodsList.length; i++) {
			response.goodsList[i].hormone_supp = (response.goodsList[i].hormone_supp != undefined) ?
				response.goodsList[i].hormone_supp.join("<br/>") : undefined;
			response.goodsList[i].circulation_promot = (response.goodsList[i].circulation_promot != undefined) ?
				response.goodsList[i].circulation_promot.join("<br/>") : undefined;
			response.goodsList[i].cell_activation = (response.goodsList[i].cell_activation != undefined) ?
				response.goodsList[i].cell_activation.join("<br/>") : undefined;
			response.goodsList[i].bulge_activation = (response.goodsList[i].bulge_activation != undefined) ?
				response.goodsList[i].bulge_activation.join("<br/>") : undefined;
			response.goodsList[i].growth_promot = (response.goodsList[i].growth_promot != undefined) ?
				response.goodsList[i].growth_promot.join("<br/>") : undefined;	
			response.goodsList[i].moist = (response.goodsList[i].moist != undefined) ?
				response.goodsList[i].moist.join("<br/>") : undefined;	
			response.goodsList[i].anti_virus = (response.goodsList[i].anti_virus != undefined) ?
				response.goodsList[i].anti_virus.join("<br/>") : undefined;			
		}

		$.tmpl($("#goodsCompTemplate"), response).appendTo("#goodsCompList");
	}

	//------------------
	//     初期処理
	//------------------	
	ajax({
		url: 	apiList.rankingGoodsList,
		data: 	{
			category: 'goods_display',
			keyword:  'fst'
		},
		success: showCostGoodsList
	});

});