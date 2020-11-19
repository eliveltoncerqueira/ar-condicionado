<?php
require_once '../model/Cofre.php';
require_once '../model/Temperatura.php';


session_start(); 
$temperaturaAtual = $_SESSION['temp']->getTemperaturaAtual();

if($_SESSION['cofre']->getStatusPorta()==false){
    $_SESSION['cofre']->abrirPorta();
}
if($temperaturaAtual >= 25.1){
    $_SESSION['temp']->diminuir(0.5);
    
   
}elseif ($temperaturaAtual <= 24.9){
    $_SESSION['temp']->aumentar(0.5);
} else{
 
}
$_SESSION['temp']->aumentarUmidade();
?>