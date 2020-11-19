<?php
header("Access-Control-Allow-Origin: *");
require_once '../model/Temperatura.php';
session_start(); 

$ar = file_get_contents('json/temperatura-iot.json');
$json = json_decode($ar, true);

echo $json['temperatura'];

