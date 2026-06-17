<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$categorias = $conn->query('SELECT id, nome FROM categorias ORDER BY nome');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome']; $descricao = $_POST['descricao']; $preco = (float)$_POST['preco']; $estoque = (int)$_POST['estoque']; $categoriaId = (int)$_POST['categoria_id']; $promocao = isset($_POST['promocao']) ? 1 : 0; $imagem = null;
    if (!empty($_FILES['imagem']['name'])) {
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg','jpeg','png','webp','gif'];
        if (in_array($ext, $permitidas)) {
            $nomeArquivo = uniqid('produto_', true) . '.' . $ext;
            $destinoFisico = '../../configs/imgs/' . $nomeArquivo;
            move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoFisico);
            $imagem = '../../configs/imgs/' . $nomeArquivo;
        }
    }
    $stmt = $conn->prepare('INSERT INTO produtos (nome, descricao, preco, estoque, imagem, promocao, categoria_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssdisii', $nome, $descricao, $preco, $estoque, $imagem, $promocao, $categoriaId);
    $stmt->execute();
    header('Location: index.php'); exit();
}
$current_page='admin_produtos'; include '../../configs/header.php';
?>
<main class="main"><div class="container"><h1 class="page-title"><span>Cadastrar Produto</span></h1>
<form method="POST" enctype="multipart/form-data" class="card form-grid">
<div class="form-group"><label>Nome</label><input name="nome" required></div><div class="form-group"><label>Preço</label><input type="number" step="0.01" name="preco" required></div><div class="form-group"><label>Estoque</label><input type="number" name="estoque" required></div><div class="form-group"><label>Categoria</label><select name="categoria_id" required><?php while($c=$categorias->fetch_assoc()): ?><option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option><?php endwhile; ?></select></div><div class="form-group full"><label>Descrição</label><textarea name="descricao"></textarea></div><div class="form-group"><label>Imagem</label><input type="file" name="imagem" accept="image/*"></div><div class="form-group"><label><input type="checkbox" name="promocao" style="width:auto;"> Produto em promoção</label></div><div class="form-group full"><button type="submit">Salvar Produto</button></div>
</form></div></main><?php include '../../configs/footer.php'; ?>
