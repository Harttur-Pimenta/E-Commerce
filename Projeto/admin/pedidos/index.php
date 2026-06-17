<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$current_page='admin_pedidos';
$pedidos=$conn->query('SELECT p.*, u.nome AS cliente FROM pedidos p INNER JOIN usuarios u ON p.usuario_id=u.id ORDER BY p.id DESC');
include '../../configs/header.php';
?>
<main class="main"><div class="container"><h1 class="page-title"><span>Vendas</span></h1><div class="table-wrapper"><table><thead><tr><th>ID</th><th>Cliente</th><th>Data</th><th>Total</th><th>Status</th><th>Ações</th></tr></thead><tbody><?php while($p=$pedidos->fetch_assoc()): ?><tr><td>#<?= $p['id'] ?></td><td><?= htmlspecialchars($p['cliente']) ?></td><td><?= date('d/m/Y H:i', strtotime($p['criado_em'])) ?></td><td>R$ <?= number_format($p['valor_total'],2,',','.') ?></td><td><?= htmlspecialchars($p['status']) ?></td><td><a class="btn btn-secondary btn-sm" href="detalhes.php?id=<?= $p['id'] ?>">Ver Detalhes</a></td></tr><?php endwhile; ?></tbody></table></div></div></main><?php include '../../configs/footer.php'; ?>
