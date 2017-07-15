<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json');

include_once 'config.php';

// 認証チェック
$response = new stdClass();
auth($response);

$request = json_decode(file_get_contents('php://input'), true);

// 一覧取得
$stmt = $dbh->prepare("select * from TRN_GOODS order by id asc");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
	$row->image = IMG_BASE_PATH . $row->image;
	$row->catch_phrase = $row->catch;

	// 口コミリスト取得
	$stmt2 = $dbh->prepare("select * from TRN_ASSESS where goods_id = :id");
	$stmt2->bindParam(':id', $row->id);
	$stmt2->execute();

	while($assess = $stmt2->fetch(PDO::FETCH_OBJ)) {
		$row->assessList[] = $assess;
	}

	$response->goodsList[] = $row;
}

$response->responseCode = RESPONSE_SUCCESS;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>