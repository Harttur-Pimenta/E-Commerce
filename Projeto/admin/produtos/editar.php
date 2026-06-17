<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM produtos WHERE id = ?');
$stmt->bind_param('i', $id); $stmt->execute(); $produto = $stmt->get_result()->fetch_assoc();
if (!$produto) die('Produto não encontrado.');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome=$_POST['nome']; $descricao=$_POST['descricao']; $preco=(float)$_POST['preco']; $estoque=(int)$_POST['estoque']; $categoriaId=(int)$_POST['categoria_id']; $promocao=isset($_POST['promocao'])?1:0; $imagem=$produto['imagem'];
    if (!empty($_FILES['imagem']['name'])) {
        $ext=strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
            $nomeArquivo=uniqid('produto_', true).'.'.$ext; move_uploaded_file($_FILES['imagem']['tmp_name'], '../../configs/imgs/'.$nomeArquivo); $imagem='../../configs/imgs/'.$nomeArquivo;
        }
    }
    $up=$conn->prepare('UPDATE produtos SET nome=?, descricao=?, preco=?, estoque=?, imagem=?, promocao=?, categoria_id=? WHERE id=?');
    $up->bind_param('ssdisiii', $nome,$descricao,$preco,$estoque,$imagem,$promocao,$categoriaId,$id); $up->execute();
    header('Location: index.php'); exit();
}
$categorias=$conn->query('SELECT id,nome FROM categorias ORDER BY nome');
$current_page='admin_produtos'; include '../../configs/header.php';
?>
<main class="main"><div class="container"><h1 class="page-title"><span>Editar Produto</span></h1>
<form method="POST" enctype="multipart/form-data" class="card form-grid">
<div class="form-group"><label>Nome</label><input name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required></div><div class="form-group"><label>Preço</label><input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required></div><div class="form-group"><label>Estoque</label><input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required></div><div class="form-group"><label>Categoria</label><select name="categoria_id" required><?php while($c=$categorias->fetch_assoc()): ?><option value="<?= $c['id'] ?>" <?= $produto['categoria_id']==$c['id']?'selected':'' ?>><?= htmlspecialchars($c['nome']) ?></option><?php endwhile; ?></select></div><div class="form-group full"><label>Descrição</label><textarea name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea></div><div class="form-group"><label>Imagem</label><input type="file" name="imagem" accept="image/*"></div><div class="form-group"><label><input type="checkbox" name="promocao" style="width:auto;" <?= $produto['promocao']?'checked':'' ?>> Produto em promoção</label></div><div class="form-group full"><button type="submit">Salvar Alterações</button></div>
</form></div></main><?php include '../../configs/footer.php'; ?>
