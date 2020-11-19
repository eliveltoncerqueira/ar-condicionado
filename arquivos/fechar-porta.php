<?php
require_once '../model/Cofre.php';
session_start();



if($_SESSION['cofre']->getStatusPorta()==true){
    $_SESSION['cofre']->fecharPorta();
}
