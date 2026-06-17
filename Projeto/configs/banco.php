<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$usuario = "root";
$senha = "123456";
$banco = "banco_byte";

try {
    $conn = new mysqli($host, $usuario, $senha, $banco);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
