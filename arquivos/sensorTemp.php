<?php
require_once '../model/Temperatura.php'; 
session_start(); 
$arr = array('temperatura'=>$_SESSION['temp']->getTemperaturaAtual(), 'tempMin'=>intval($_GET['temp-min']), 'tempMax'=>intval($_GET['temp-max']));

$dados_json = json_encode($arr);
$arquivo = "json/temperatura.json";
$handle = fopen($arquivo,'w');
fseek($handle, 0);
fwrite($handle,$dados_json);
fclose ($handle);

$arr2 = array('umidade'=>$_SESSION['temp']->getUmidade());
$dados_json2 = json_encode($arr2);
$arquivo2 = "json/umidade.json";
$handle2 = fopen($arquivo2,'w');
fseek($handle2, 0);
fwrite($handle2,$dados_json2);
fclose ($handle2);