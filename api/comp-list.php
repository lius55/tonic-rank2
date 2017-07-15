<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json');

include_once 'config.php';

// 一覧取得
$stmt = $dbh->prepare("select * from TRN_COMP order by id asc");
$stmt->execute();

$response = new stdClass();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
	$response->compList[] = $row;
}

$response->responseCode = RESPONSE_SUCCESS;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>