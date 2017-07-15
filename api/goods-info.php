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

// 成分の取得
$stmt = $dbh->prepare("select name,detail from TRN_GOODS_COMP,TRN_COMP where goods_id = :id and TRN_COMP.id = TRN_GOODS_COMP.comp_id");
$stmt->bindParam(':id', $goodsId);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
	$response->goodsInfo->compList[] = $row;
}

$response->responseCode = RESPONSE_SUCCESS;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>