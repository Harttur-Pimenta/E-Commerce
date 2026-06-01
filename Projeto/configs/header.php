<?php

$nav_items = [
    'destaques'   => ['href' => '../destaques/index.php', 'label' => 'Promoções'],
    'hardware'       => ['href' => '../hardware/index.php',      'label' => 'Hardware'],
    'pcgamer'      => ['href' => '../pcgamer/index.php',     'label' => 'PC Gamer'],
    'escritorio' => ['href' => '../escritorio/index.php','label' => 'Escritório'],
    'acessorios' => ['href' => '../acessorios/index.php','label' => 'Acessórios']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="/Projeto/img/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../configs/style.css">

    <title>ByteStore</title>
</head>

<body>

<div class="page-wrapper">

<header class="header">

    <div class="container">

        <a href="../destaques/index.php" class="logo">
            <div class="logo-mark">BS</div>
            <div class="logo-text">
                <span>ByteStore</span>
            </div>
        </a>

        <nav class="navbar">

            <?php foreach ($nav_items as $key => $item): ?>

                <a href="<?= $item['href'] ?>"
                   class="<?= ($current_page ?? '') === $key ? 'active' : '' ?>">
                    <?= $item['label'] ?>
                </a>

            <?php endforeach; ?>

        </nav>

        <div class="header-actions">

            <a href="../carrinho/index.php" class="btn-cart" title="Carrinho">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="currentColor"
                    viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .49.402L2.89 3H14.5a.5.5 0 0 1 .49.598l-1.5 7A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.49-.402L1.61 2H.5a.5.5 0 0 1-.5-.5z"/>
                    <path d="M5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
            </a>

            <a href="../perfil/index.php" class="avatar" title="Meu Perfil">
                <?= strtoupper(substr($_SESSION['usuario_nome'] ?? 'U', 0, 1)) ?>
            </a>

        </div>

    </div>

</header>