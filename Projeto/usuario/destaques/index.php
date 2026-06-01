<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = 'destaques';

require_once '../../configs/banco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $qtd = (int) $_POST['qtd'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (!isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] = [
            'nome' => $nome,
            'preco' => $preco,
            'qtd' => $qtd
        ];
    } else {
        $_SESSION['carrinho'][$id]['qtd'] += $qtd;
    }

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$sqlPromocoes = "SELECT * FROM produtos WHERE promocao = 1 ORDER BY id DESC LIMIT 4";
$promocoes = $conn->query($sqlPromocoes);

$sqlProdutos = "SELECT * FROM produtos ORDER BY id DESC";
$produtos = $conn->query($sqlProdutos);

include '../../configs/header.php';
?>


<main class="main">
        <div class="container">

    
            <div>
                <h1 class="page-title"><span>EM Destaque 🔥</span></h1>
            </div>
            

            <!-- Destaques -->

            <div class="section-label" style="margin-top:2rem;">
                📦 Promoções e produtos disponíveis na ByteStore
            </div>
            <div class="stats-grid">

                <?php while ($produto = $promocoes->fetch_assoc()): ?>

                    <div class="stat-card">

                        <?php if (!empty($produto['imagem'])): ?>
                            <img src="<?= htmlspecialchars($produto['imagem']) ?>"
                                alt="<?= htmlspecialchars($produto['nome']) ?>"
                                class="product-image">
                        <?php else: ?>
                            <div class="product-image-empty">🏷️</div>
                        <?php endif; ?>

                        <div class="stat-label">
                            <?= htmlspecialchars($produto['nome']) ?>
                        </div>

                        <div style="margin:1rem 0;color:var(--muted);font-size:1.2rem;">
                            <?= htmlspecialchars($produto['descricao']) ?>
                        </div>

                        <div class="stat-value">
                            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </div>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <input type="hidden" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>">
                            <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">

                            <div class="produto-acoes">
                                <input type="number" name="qtd" value="1" min="1" class="qtd-input">

                                <button type="submit">
                                    Adicionar
                                </button>
                            </div>
                        </form>

                    </div>

                <?php endwhile; ?>

            </div>

            <!-- Todos os Produtos -->

            <div class="section-label" style="margin-top:4rem;">
                📦 Todos os Produtos
            </div>

            <div class="stats-grid">

                <?php while ($produto = $produtos->fetch_assoc()): ?>

                    <div class="stat-card">

                        <?php if (!empty($produto['imagem'])): ?>
                            <img src="<?= htmlspecialchars($produto['imagem']) ?>"
                                alt="<?= htmlspecialchars($produto['nome']) ?>"
                                class="product-image">
                        <?php else: ?>
                            <div class="product-image-empty">📦</div>
                        <?php endif; ?>

                        <div class="stat-label">
                            <?= htmlspecialchars($produto['nome']) ?>
                        </div>

                        <div style="margin:1rem 0;color:var(--muted);font-size:1.2rem;">
                            <?= htmlspecialchars($produto['descricao']) ?>
                        </div>

                        <div class="stat-value">
                            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </div>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <input type="hidden" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>">
                            <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">

                            <div class="produto-acoes">
                                <input type="number" name="qtd" value="1" min="1" class="qtd-input">

                                <button type="submit">
                                    Adicionar
                                </button>
                            </div>
                        </form>

                    </div>

                <?php endwhile; ?>

            </div>

        </div>

    </div>
</main>

<?php include '../../configs/footer.php'; ?>