<?php
function adicionar_ao_carrinho(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['adicionar_carrinho'])) {
        return;
    }

    $id = (int)$_POST['id'];
    $nome = trim($_POST['nome']);
    $preco = (float)$_POST['preco'];
    $qtd = max(1, (int)$_POST['qtd']);

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

    $_SESSION['sucesso'] = $nome . ' adicionado ao carrinho!';
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}

function render_produto_card(array $produto): void {
    ?>
    <div class="stat-card">
        <?php if (!empty($produto['imagem'])): ?>
            <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" class="product-image">
        <?php else: ?>
            <div class="product-image-empty">📦</div>
        <?php endif; ?>

        <?php if (!empty($produto['promocao'])): ?>
            <div class="product-badge">Promoção</div>
        <?php endif; ?>

        <div class="stat-label"><?= htmlspecialchars($produto['nome']) ?></div>
        <div class="product-desc"><?= htmlspecialchars($produto['descricao'] ?? '') ?></div>
        <div class="stat-value">R$ <?= number_format((float)$produto['preco'], 2, ',', '.') ?></div>

        <form method="POST">
            <input type="hidden" name="adicionar_carrinho" value="1">
            <input type="hidden" name="id" value="<?= (int)$produto['id'] ?>">
            <input type="hidden" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>">
            <input type="hidden" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>">
            <div class="produto-acoes">
                <input type="number" name="qtd" value="1" min="1" class="qtd-input">
                <button type="submit">Adicionar</button>
            </div>
        </form>
    </div>
    <?php
}

function mostrar_alerta_sucesso(): void {
    if (!empty($_SESSION['sucesso'])) {
        echo '<script>alert(' . json_encode($_SESSION['sucesso']) . ');</script>';
        unset($_SESSION['sucesso']);
    }
}
?>
