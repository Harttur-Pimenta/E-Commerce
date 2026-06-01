<?php

$host = "localhost";
$usuario = "root";
$senha = "123456";
$banco = "banco_byte";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>