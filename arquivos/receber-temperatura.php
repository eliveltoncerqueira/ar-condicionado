<?php
header("Access-Control-Allow-Origin: *");
$conn = include_once 'db/connect.php';
$json = file_get_contents('php://input');
$json_str = json_decode($json, true); 
$temperatura = $json_str['temperatura'];



$arquivo = "json/temperatura-iot.json";
$handle = fopen($arquivo,'w');
fseek($handle, 0);
fwrite($handle,$json);
fclose ($handle);

