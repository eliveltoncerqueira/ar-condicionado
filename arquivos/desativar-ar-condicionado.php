<?php
header("Access-Control-Allow-Origin: *");
$json = file_get_contents('php://input');
$json_str = json_decode($json, true);

$arr= array("status"=>0);
$dados_json = json_encode($arr);
$arquivo = "json/ar-condicionado.json";
$handle = fopen($arquivo,'w');
fseek($handle, 0);
fwrite($handle,$dados_json);
fclose ($handle);



?>