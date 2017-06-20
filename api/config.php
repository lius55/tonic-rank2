<?php

// DB接続設定
define('DB_HOST', 'localhost');
define('DB_NAME', 'sms');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

// 文字化け対策
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");

// PHPのエラーを表示するように設定
error_reporting(E_ALL & ~E_NOTICE);

$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $options);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
// ステータスコード
define('PROCESS_ERROR', 'process error');
define('RESPONSE_SUCCESS', 'success');
define('RESPONSE_ERROR', 'error');
define('INVALID_REQUEST', 'invalid request');

define('IMG_BASE_PATH', 'http://localhost:8888/sms/img/goods/');


function auth($response) {
	if(isset($_SESSION["auth"])) {
		$response->responseCode = RESPONSE_ERROR;
		$response->responseMsg = '認証失敗。';
		http_response_code(403);
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit;
	}
}

?>