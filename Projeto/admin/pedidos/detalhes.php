<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$id=(int)($_GET['id']??0);
if($_SERVER['REQUEST_METHOD']==='POST'){ $status=$_POST['status']; $stmt=$conn->prepare('UPDATE pedidos SET status=? WHERE id=?'); $stmt->bind_param('si',$status,$id); $stmt->execute(); header('Location: detalhes.php?id='.$id); exit(); }
$stmt=$conn->prepare('SELECT p.*, u.nome AS cliente FROM pedidos p INNER JOIN usuarios u ON p.usuario_id=u.id WHERE p.id=?'); $stmt->bind_param('i',$id); $stmt->execute(); $pedido=$stmt->get_result()->fetch_assoc(); if(!$pedido) die('Pedido não encontrado.');
$itensStmt=$conn->prepare('SELECT i.*, pr.nome AS produto FROM itens_pedido i INNER JOIN produtos pr ON i.produto_id=pr.id WHERE i.pedido_id=?'); $itensStmt->bind_param('i',$id); $itensStmt->execute(); $itens=$itensStmt->get_result();
$current_page='admin_pedidos'; include '../../configs/header.php';
?>
<main class="main"><div class="container"><div class="page-header"><h1 class="page-title"><span>Pedido #<?= $pedido['id'] ?></span></h1><a class="btn btn-secondary btn-sm" href="index.php">Voltar</a></div><div class="card"><p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['cliente']) ?></p><p><strong>Total:</strong> R$ <?= number_format($pedido['valor_total'],2,',','.') ?></p><form method="POST" style="margin-top:1rem;"><label>Status</label><select name="status"><option <?= $pedido['status']=='Pendente'?'selected':'' ?>>Pendente</option><option <?= $pedido['status']=='Pago'?'selected':'' ?>>Pago</option><option <?= $pedido['status']=='Enviado'?'selected':'' ?>>Enviado</option><option <?= $pedido['status']=='Cancelado'?'selected':'' ?>>Cancelado</option></select><button type="submit">Atualizar Status</button></form></div><div class="section-label" style="margin-top:2rem;">Itens</div><div class="table-wrapper"><table><thead><tr><th>Produto</th><th>Qtd</th><th>Preço Unitário</th><th>Subtotal</th></tr></thead><tbody><?php while($i=$itens->fetch_assoc()): ?><tr><td><?= htmlspecialchars($i['produto']) ?></td><td><?= $i['quantidade'] ?></td><td>R$ <?= number_format($i['preco_unitario'],2,',','.') ?></td><td>R$ <?= number_format($i['subtotal'],2,',','.') ?></td></tr><?php endwhile; ?></tbody></table></div></div></main><?php include '../../configs/footer.php'; ?>
