<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json');

include_once 'config.php';

$request = json_decode(file_get_contents('php://input'), true);
$goodsId = $request['goodsId'];

// 一覧取得
$stmt = $dbh->prepare("select * from TRN_GOODS where id = :id");
$stmt->bindParam(':id', $goodsId, PDO::PARAM_INT);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
	$row->image = IMG_BASE_PATH . $row->image;
	$row->catch_phrase = $row->catch;
	$response->goodsInfo = $row;
}

// 口コミリスト取得
$stmt = $dbh->prepare("select * from TRN_ASSESS where goods_id = :id");
$stmt->bindParam(':id', $goodsId);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
	$response->goodsInfo->assessList[] = $row;
}

$compDefList = array();
$compDefList[] = array("effect"=>"男性ホルモン抑制", "column"=>"hormone_supp");
$compDefList[] = array("effect"=>"血行促進", "column"=>"circulation_promot");
$compDefList[] = array("effect"=>"毛母細胞活性化", "column"=>"cell_activation");
$compDefList[] = array("effect"=>"バジル活性化", "column"=>"bulge_activation");
$compDefList[] = array("effect"=>"成長促進", "column"=>"growth_promot");
$compDefList[] = array("effect"=>"保湿", "column"=>"moist");
$compDefList[] = array("effect"=>"抗酸化・殺菌", "column"=>"anti_virus");

foreach ($compDefList as $comp) {
	// echo "comp=" . $comp["effect"] . " " . $comp["column"];
	// 成分の取得
	$stmt = $dbh->prepare("select name from TRN_GOODS_COMP,TRN_COMP where goods_id=:id and TRN_COMP.id = TRN_GOODS_COMP.comp_id and " . $comp["column"] . ">0");
	$stmt->bindParam(":id", $goodsId);
	$stmt->execute();

	$row = new stdClass();
	$row->effect = $comp["effect"];
	$row->compName = array();
	while($compName = $stmt->fetch(PDO::FETCH_OBJ)) {
		$row->compName[] = $compName->name;
	}
	$response->goodsInfo->compList[] = $row;
}

$response->responseCode = RESPONSE_SUCCESS;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>