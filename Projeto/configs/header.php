<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/auth.php';

if (usuario_admin()) {
    $nav_items = [
        'admin_produtos' => ['href' => '/Projeto/admin/produtos/index.php', 'label' => 'CRUD de Produtos'],
        'admin_usuarios' => ['href' => '/Projeto/admin/usuarios/index.php', 'label' => 'CRUD de Usuários'],
        'admin_pedidos'  => ['href' => '/Projeto/admin/pedidos/index.php',  'label' => 'Relatório de Vendas']
    ];

    $home_link = '/Projeto/admin/produtos/index.php';
} else {
    $nav_items = [
        'destaques'  => ['href' => '/Projeto/usuario/destaques/index.php', 'label' => 'Promoções'],
        'hardware'   => ['href' => '/Projeto/usuario/hardware/index.php',   'label' => 'Hardware'],
        'pcgamer'    => ['href' => '/Projeto/usuario/pcgamer/index.php',    'label' => 'PC Gamer'],
        'escritorio' => ['href' => '/Projeto/usuario/escritorio/index.php', 'label' => 'Escritório'],
        'acessorios' => ['href' => '/Projeto/usuario/acessorios/index.php', 'label' => 'Acessórios']
    ];

    $home_link = '/Projeto/usuario/destaques/index.php';
}

$itensCarrinho = total_itens_carrinho();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Projeto/configs/style.css?v=3">
    <title>ByteStore</title>
</head>
<body>
<div class="page-wrapper">
<header class="header">
    <div class="container">
        <a href="<?= $home_link ?>" class="logo">
            <div class="logo-mark">BS</div>
            <div class="logo-text"><span>ByteStore</span></div>
        </a>

        <nav class="navbar">
            <?php foreach ($nav_items as $key => $item): ?>
                <a href="<?= $item['href'] ?>" class="<?= ($current_page ?? '') === $key ? 'active' : '' ?>">
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="header-actions">
            <?php if (usuario_admin()): ?>
                <a class="avatar" title="Usuário Administrador">
                        <?= strtoupper(substr($_SESSION['usuario_nome'] ?? 'U', 0, 1)) ?>
                </a>
                <a href="/Projeto/usuario/logout/index.php" class="btn-logout">Sair</a>
            <?php else: ?>
                <a href="/Projeto/usuario/carrinho/index.php" class="btn-cart" title="Carrinho">
                    🛒<?php if ($itensCarrinho > 0): ?><span class="cart-count"><?= $itensCarrinho ?></span><?php endif; ?>
                </a>

                <?php if (usuario_logado()): ?>
                    <a href="/Projeto/usuario/pedidos/index.php" class="avatar" title="Meus pedidos">
                        <?= strtoupper(substr($_SESSION['usuario_nome'] ?? 'U', 0, 1)) ?>
                    </a>
                    <a href="/Projeto/usuario/logout/index.php" class="btn-logout">Sair</a>
                <?php else: ?>
                    <a href="/Projeto/usuario/login/index.php" class="btn btn-primary">Entrar</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</header>
