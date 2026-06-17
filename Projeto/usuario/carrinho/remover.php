<?php
session_start();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0 && isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
}
header('Location: index.php');
exit();
