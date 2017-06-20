<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json');

include_once 'config.php';

$response = new stdClass();

$request = json_decode(file_get_contents('php://input'), true);
$category = $request['category'];
$keyword = $request['keyword'];

// 対象goodsId取得
$stmt = $dbh->prepare("select * from MST_SYSTEM_CTRL where category = :category and keyword = :keyword");
$stmt->bindParam(':category', $category);
$stmt->bindParam(':keyword', $keyword);
$stmt->execute();
$row = $stmt->fetch();

foreach(explode(",", $row['value']) as $goodsId) {

	// echo "goodId=" . $goodsId . "¥n";
	// goods取得
	$stmt = $dbh->prepare("select * from TRN_GOODS where id = " . $goodsId);
	$stmt->bindParam(':id', $goodsId, PDO::PARAM_INT);
	$stmt->execute();
	$goods = new stdClass();
	$goods = $stmt->fetch(PDO::FETCH_OBJ);

	// 口コミリスト取得
	$stmt = $dbh->prepare("select * from TRN_ASSESS where goods_id = :id");
	$stmt->bindParam(':id', $goodsId, PDO::PARAM_INT);
	$stmt->execute();

	while($assess = $stmt->fetch(PDO::FETCH_OBJ)) {
		$goods->assessList[] = $assess;
	}

	// 成分の取得
	$stmt = $dbh->prepare("select * from TRN_GOODS_COMP where goods_id = :id");
	$stmt->bindParam(':id', $goodsId, PDO::PARAM_INT);
	$stmt->execute();

	while($comp = $stmt->fetch(PDO::FETCH_OBJ)) {
		$goods->compList[] = $comp;
	}

	$response->goodsList[] = $goods;
}

$response->responseCode = RESPONSE_SUCCESS;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>