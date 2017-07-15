$(function() {

	var showGoodsIno = function(response) {
		$.tmpl($("#mainTemplate"), response.goodsInfo).appendTo("#main");
		// #fffde9,#ff8776
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
	                	parseInt(response.goodsInfo.hormone_suppress), 
	                	parseInt(response.goodsInfo.circulation_prompt), 
	                	parseInt(response.goodsInfo.cell_activation), 
	                	parseInt(response.goodsInfo.bulge_activation), 
	                	parseInt(response.goodsInfo.growth_prompt)
	                ]
	            }
	        ]
	    };

	    var ctx = document.getElementById("radarChart").getContext("2d");
	    var radarChart = new Chart(ctx).Radar(data);
	};

	//------------------
	//     初期処理
	//------------------
	ajax({
		url: 	apiList.goodsInfo,
		data: 	{
			goodsId: location.search.match(/id=(.*?)(&|$)/)[1]
		},
		success: showGoodsIno
	});

});