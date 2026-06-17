<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_login();
$current_page = 'pedidos';
$usuarioId = (int)$_SESSION['usuario_id'];
$stmt = $conn->prepare('SELECT id, criado_em, valor_total, forma_pagamento, status FROM pedidos WHERE usuario_id = ? ORDER BY id DESC');
$stmt->bind_param('i', $usuarioId);
$stmt->execute();
$pedidos = $stmt->get_result();
include '../../configs/header.php';
if (!empty($_SESSION['sucesso'])) { echo '<script>alert(' . json_encode($_SESSION['sucesso']) . ');</script>'; unset($_SESSION['sucesso']); }
?>
<main class="main"><div class="container">
    <h1 class="page-title"><span>Meus Pedidos</span></h1>
    <div class="table-wrapper"><table>
        <thead><tr><th>ID</th><th>Data</th><th>Total</th><th>Pagamento</th><th>Status</th></tr></thead>
        <tbody>
        <?php if ($pedidos->num_rows > 0): while ($p = $pedidos->fetch_assoc()): ?>
            <tr><td>#<?= $p['id'] ?></td><td><?= date('d/m/Y H:i', strtotime($p['criado_em'])) ?></td><td>R$ <?= number_format($p['valor_total'], 2, ',', '.') ?></td><td><?= htmlspecialchars($p['forma_pagamento']) ?></td><td><?= htmlspecialchars($p['status']) ?></td></tr>
        <?php endwhile; else: ?>
            <tr><td colspan="5">Nenhum pedido realizado.</td></tr>
        <?php endif; ?>
        </tbody>
    </table></div>
</div></main>
<?php include '../../configs/footer.php'; ?>
