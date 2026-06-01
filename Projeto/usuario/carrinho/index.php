<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = 'escritorio';

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

    header("Location: carrinho.php");
    exit();
}

$sqlProdutos = "SELECT * FROM produtos WHERE categoria = 'escritorio' ORDER BY id DESC";
$produtos = $conn->query($sqlProdutos);

include '../../configs/header.php';
?>

<main class="main">
        <div class="container">

    
            <div>
                <h1 class="page-title"><span>Carrinho </span></h1>
            </div>
            

            <!-- Produtos de Escritorio -->

            <div class="section-label" style="margin-top:2rem;">
                Carrinho
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $total = 0;
                    ?>

                    <?php if (!empty($_SESSION['carrinho'])): ?>

                        <?php foreach ($_SESSION['carrinho'] as $id => $item): ?>

                            <?php
                            $subtotal = $item['preco'] * $item['qtd'];
                            $total += $subtotal;
                            ?>

                            <tr>
                                <td>
                                    <?= htmlspecialchars($item['nome']) ?>
                                </td>

                                <td>
                                    R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                                </td>

                                <td>
                                    <?= $item['qtd'] ?>
                                </td>

                                <td>
                                    R$ <?= number_format($subtotal, 2, ',', '.') ?>
                                </td>

                                <td>
                                    <a href="remover.php?id=<?= $id ?>" class="btn-delete">
                                        Remover
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        <tr>
                            <td colspan="3">
                                <strong>Total</strong>
                            </td>

                            <td colspan="2">
                                <strong>
                                    R$ <?= number_format($total, 2, ',', '.') ?>
                                </strong>
                            </td>
                        </tr>

                    <?php else: ?>

                        <tr>
                            <td colspan="5">
                                Carrinho vazio.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>

        </div>

    </div>
</main>

<?php include '../../configs/footer.php'; ?>