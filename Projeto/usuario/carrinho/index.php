<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_page = 'carrinho';
require_once '../../configs/banco.php';
include '../../configs/header.php';
?>
<main class="main">
    <div class="container">
        <h1 class="page-title"><span>Carrinho</span></h1>
        <div class="section-label" style="margin-top:2rem;">Itens adicionados</div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Produto</th><th>Preço Unitário</th><th>Quantidade</th><th>Subtotal</th><th>Ação</th></tr></thead>
                <tbody>
                <?php $total = 0; ?>
                <?php if (!empty($_SESSION['carrinho'])): ?>
                    <?php foreach ($_SESSION['carrinho'] as $id => $item): ?>
                        <?php $subtotal = (float)$item['preco'] * (int)$item['qtd']; $total += $subtotal; ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nome']) ?></td>
                            <td>R$ <?= number_format((float)$item['preco'], 2, ',', '.') ?></td>
                            <td><?= (int)$item['qtd'] ?></td>
                            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                            <td><a href="remover.php?id=<?= (int)$id ?>" class="btn-delete">Remover</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr><td colspan="3"><strong>Total</strong></td><td colspan="2"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td></tr>
                <?php else: ?>
                    <tr><td colspan="5">Carrinho vazio.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($_SESSION['carrinho'])): ?>
            <div style="margin-top:2rem;display:flex;gap:1rem;justify-content:flex-end;">
                <a href="limpar.php" class="btn btn-secondary">Limpar Carrinho</a>
                <a href="/Projeto/usuario/checkout/index.php" class="btn btn-primary">Finalizar Compra</a>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php include '../../configs/footer.php'; ?>
