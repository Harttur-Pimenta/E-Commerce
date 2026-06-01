<?php
session_start();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }

}

header("Location: index.php");
exit;