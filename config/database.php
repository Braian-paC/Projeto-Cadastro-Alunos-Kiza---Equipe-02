<?php

$hostname = "crossover.proxy.rlwy.net";
$bancodedados = "registroAlunos";
$usuario = "root";
$senha = "lpZdolCpdlLPRFDHpvooJbHkwPSVDRYV";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}