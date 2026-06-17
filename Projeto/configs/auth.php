<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuario_logado(): bool {
    return isset($_SESSION['usuario_id']);
}

function usuario_admin(): bool {
    return isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin';
}

function exigir_login(): void {
    if (!usuario_logado()) {
        header('Location: /Projeto/usuario/login/index.php');
        exit();
    }
}

function exigir_admin(): void {
    exigir_login();
    if (!usuario_admin()) {
        header('Location: /Projeto/usuario/destaques/index.php');
        exit();
    }
}

function total_itens_carrinho(): int {
    $total = 0;
    if (!empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $item) {
            $total += (int)($item['qtd'] ?? 0);
        }
    }
    return $total;
}
?>
