<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_login();

if (empty($_SESSION['carrinho'])) {
    header('Location: /Projeto/usuario/carrinho/index.php');
    exit();
}

$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $total += (float)$item['preco'] * (int)$item['qtd'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $forma = $_POST['forma_pagamento'] ?? 'PIX';
    $status = 'Pago';
    $usuarioId = (int)$_SESSION['usuario_id'];

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare('INSERT INTO pedidos (usuario_id, valor_total, forma_pagamento, status) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('idss', $usuarioId, $total, $forma, $status);
        $stmt->execute();
        $pedidoId = $conn->insert_id;

        $stmtItem = $conn->prepare('INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario, subtotal) VALUES (?, ?, ?, ?, ?)');
        foreach ($_SESSION['carrinho'] as $produtoId => $item) {
            $qtd = (int)$item['qtd'];
            $preco = (float)$item['preco'];
            $subtotal = $qtd * $preco;
            $pid = (int)$produtoId;
            $stmtItem->bind_param('iiidd', $pedidoId, $pid, $qtd, $preco, $subtotal);
            $stmtItem->execute();
        }
        $conn->commit();
        unset($_SESSION['carrinho']);
        $_SESSION['sucesso'] = 'Compra finalizada com sucesso! Pedido #' . $pedidoId;
        header('Location: /Projeto/usuario/pedidos/index.php');
        exit();
    } catch (Throwable $e) {
        $conn->rollback();
        die('Erro ao finalizar pedido: ' . $e->getMessage());
    }
}
$current_page = 'checkout';
include '../../configs/header.php';
?>
<main class="main"><div class="container">
    <h1 class="page-title"><span>Pagamento</span></h1>
    <div class="card">
        <h2>Resumo do Pedido</h2>
        <p class="cart-total">Total: R$ <?= number_format($total, 2, ',', '.') ?></p>
        <form method="POST">
            <div class="form-group">
                <label>Forma de pagamento</label>
                <select name="forma_pagamento" required>
                    <option value="PIX">PIX</option>
                    <option value="Boleto">Boleto</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                </select>
            </div>
            <button type="submit">Confirmar Pagamento Simulado</button>
        </form>
    </div>
</div></main>
<?php include '../../configs/footer.php'; ?>
