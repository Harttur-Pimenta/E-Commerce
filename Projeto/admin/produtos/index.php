<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$current_page = 'admin_produtos';
$produtos = $conn->query('SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC');
include '../../configs/header.php';
?>
<main class="main"><div class="container">
    <div class="page-header"><h1 class="page-title"><span>Admin Produtos</span></h1><a class="btn btn-primary" href="cadastrar.php">+ Produto</a></div>
    <div class="table-wrapper"><table>
        <thead><tr><th>ID</th><th>Produto</th><th>Categoria</th><th>Preço</th><th>Estoque</th><th>Promoção</th><th>Ações</th></tr></thead>
        <tbody><?php while ($p = $produtos->fetch_assoc()): ?>
            <tr><td><?= $p['id'] ?></td><td><?= htmlspecialchars($p['nome']) ?></td><td><?= htmlspecialchars($p['categoria_nome'] ?? '') ?></td><td>R$ <?= number_format($p['preco'],2,',','.') ?></td><td><?= $p['estoque'] ?></td><td><?= $p['promocao'] ? 'Sim' : 'Não' ?></td><td><a class="btn btn-secondary btn-sm" href="editar.php?id=<?= $p['id'] ?>">Editar</a> <a class="btn-delete" href="excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir produto?')">Excluir</a></td></tr>
        <?php endwhile; ?></tbody>
    </table></div>
</div></main>
<?php include '../../configs/footer.php'; ?>
