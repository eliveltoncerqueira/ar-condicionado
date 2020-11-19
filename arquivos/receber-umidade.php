<?php
$conn = include_once 'db/connect.php';
header("Access-Control-Allow-Origin: *");
$json = file_get_contents('php://input');
$json_str = json_decode($json, true);


$arquivo = "json/umidade-iot.json";
$handle = fopen($arquivo,'w');
fseek($handle, 0);
fwrite($handle,$json);
fclose ($handle);
