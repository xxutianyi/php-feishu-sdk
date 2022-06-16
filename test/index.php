<?php

require_once "../vendor/autoload.php";

$appId = "cli_a221a91a6f78900e";
$appSecret = "GfSJGhmuUbos3QXDz5lw7bmabgJgM23h";

$config = new \xXutianyi\FeishuSDK\Config($appId, $appSecret);

$authen = new \xXutianyi\FeishuSDK\SDK\Authen($config);


echo json_encode($res);