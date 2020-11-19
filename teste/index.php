<?php
$teste = "Elivelton";
$command = escapeshellcmd('python3 teste.py '.$teste);
$output = exec($command);

echo $output;