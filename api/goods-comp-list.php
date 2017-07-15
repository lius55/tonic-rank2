<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json');

include_once 'config.php';

// 一覧取得
$stmt = $dbh->prepare("select id,name,image from TRN_GOODS");
$stmt->execute();

$compArray[] = array("key"=>"hormone_supp", "text"=>"男性ホルモン抑制");
$compArray[] = array("key"=>"circulation_promot", "text"=>"血行促進");
$compArray[] = array("key"=>"cell_activation", "text"=>"毛母細胞活性化");
$compArray[] = array("key"=>"bulge_activation", "text"=>"バルジ活性化");
$compArray[] = array("key"=>"growth_promot", "text"=>"成長促進");
$compArray[] = array("key"=>"moist", "text"=>"保湿");
$compArray[] = array("key"=>"anti_virus", "text"=>"抗酸化・殺菌");

$response = new stdClass();
while($row = $stmt->fetch()) {

	foreach ($compArray as $comp) {
		$stmt_comp = $dbh->prepare("select name from TRN_COMP,TRN_GOODS_COMP where goods_id=:goods_id " .
			"and TRN_GOODS_COMP.comp_id=TRN_COMP.id and " . $comp["key"] . ">0");
		$stmt_comp->bindParam(":goods_id", $row["id"]);
		$stmt_comp->execute();

		while($compRow = $stmt_comp->fetch(PDO::FETCH_OBJ)){
			$row[$comp["key"]][] = $compRow->name;
		}
	}

	$row["image"] = IMG_BASE_PATH . $row["image"];
	$response->goodsList[] = $row;
}

$response->responseCode = RESPONSE_SUCCESS;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>