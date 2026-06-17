<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_page = 'destaques';
require_once '../../configs/banco.php';
require_once '../../configs/funcoes.php';
adicionar_ao_carrinho();

$promocoes = $conn->query("SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id WHERE p.promocao = 1 ORDER BY p.id DESC LIMIT 8");
$produtos = $conn->query("SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC");
include '../../configs/header.php';
mostrar_alerta_sucesso();
?>
<main class="main">
    <div class="container">
        <h1 class="page-title"><span>EM Destaque 🔥</span></h1>
        <div class="section-label" style="margin-top:2rem;">Promoções disponíveis na ByteStore</div>
        <div class="stats-grid">
            <?php if ($promocoes->num_rows > 0): ?>
                <?php while ($produto = $promocoes->fetch_assoc()) render_produto_card($produto); ?>
            <?php else: ?>
                <div class="empty-state">Nenhum produto em promoção.</div>
            <?php endif; ?>
        </div>

        <div class="section-label" style="margin-top:4rem;">📦 Todos os Produtos</div>
        <div class="stats-grid">
            <?php if ($produtos->num_rows > 0): ?>
                <?php while ($produto = $produtos->fetch_assoc()) render_produto_card($produto); ?>
            <?php else: ?>
                <div class="empty-state">Nenhum produto cadastrado.</div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include '../../configs/footer.php'; ?>
