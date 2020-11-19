<?php
header("Access-Control-Allow-Origin: *");
$json = file_get_contents('php://input');
$json_str = json_decode($json, true);
$temp = (($json_str['tempMin']+$json_str['tempMax'])/2);

$arr= array('temperatura-ar'=>$temp, 'status'=>1);
$dados_json = json_encode($arr);
$arquivo = "json/ar-condicionado.json";
$handle = fopen($arquivo,'w');
fseek($handle, 0);
fwrite($handle,$dados_json);
fclose ($handle);





?>