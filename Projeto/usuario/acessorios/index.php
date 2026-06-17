<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_page = 'acessorios';
require_once '../../configs/banco.php';
require_once '../../configs/funcoes.php';
adicionar_ao_carrinho();

$stmt = $conn->prepare("SELECT p.*, c.nome AS categoria_nome FROM produtos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE c.slug = ? ORDER BY p.id DESC");
$slug = 'acessorios';
$stmt->bind_param('s', $slug);
$stmt->execute();
$produtos = $stmt->get_result();
include '../../configs/header.php';
mostrar_alerta_sucesso();
?>
<main class="main">
    <div class="container">
        <h1 class="page-title"><span>Acessórios</span></h1>
        <div class="section-label" style="margin-top:2rem;">Todos os produtos de Acessórios</div>
        <div class="stats-grid">
            <?php if ($produtos->num_rows > 0): ?>
                <?php while ($produto = $produtos->fetch_assoc()) render_produto_card($produto); ?>
            <?php else: ?>
                <div class="empty-state">Nenhum produto nesta categoria.</div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include '../../configs/footer.php'; ?>
