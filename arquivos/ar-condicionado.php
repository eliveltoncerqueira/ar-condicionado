<?php

require_once '../model/ArCondicionado.php';
require_once '../model/Temperatura.php';
session_start();

$ar = file_get_contents('json/ar-condicionado.json');
$json = json_decode($ar, true);


if($json['status']){
   
    $_SESSION['temp']->diminuirUmidade();
    echo "Ligado<br>";
    echo $json['temperatura-ar']."ºC";
    if($json['temperatura-ar'] > $_SESSION['temp']->getTemperaturaAtual()){
        $velMudancaTemp = (1 - (($json['temperatura-ar'] - $_GET['tempExterna']) * 0.03));
        if(($json['temperatura-ar'] - $_SESSION['temp']->getTemperaturaAtual()) < $velMudancaTemp){
            $_SESSION['temp']->aumentar(($json['temperatura-ar'] - $_SESSION['temp']->getTemperaturaAtual()));
        }else{
            $_SESSION['temp']->aumentar($velMudancaTemp);
        }
        
    }else if($json['temperatura-ar'] < $_SESSION['temp']->getTemperaturaAtual()){
        $velMudancaTemp = (1 - (($_GET['tempExterna'] - $json['temperatura-ar']) * 0.03));
        
        if(($_SESSION['temp']->getTemperaturaAtual() - $json['temperatura-ar']) < $velMudancaTemp){
            $_SESSION['temp']->diminuir(($_SESSION['temp']->getTemperaturaAtual() - $json['temperatura-ar']));
        }else{
            $_SESSION['temp']->diminuir($velMudancaTemp);
        }
        
    }else{
        
    }
}else{
    echo "Desligado";
}



