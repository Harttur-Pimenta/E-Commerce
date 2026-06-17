<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$id=(int)($_GET['id']??0); $stmt=$conn->prepare('SELECT * FROM usuarios WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); $usuario=$stmt->get_result()->fetch_assoc(); if(!$usuario) die('Usuário não encontrado.');
if ($_SERVER['REQUEST_METHOD']==='POST') { $nome=$_POST['nome']; $email=$_POST['email']; $tipo=$_POST['tipo']; if(!empty($_POST['senha'])){ $senha=password_hash($_POST['senha'], PASSWORD_DEFAULT); $up=$conn->prepare('UPDATE usuarios SET nome=?, email=?, tipo=?, senha=? WHERE id=?'); $up->bind_param('ssssi',$nome,$email,$tipo,$senha,$id);} else { $up=$conn->prepare('UPDATE usuarios SET nome=?, email=?, tipo=? WHERE id=?'); $up->bind_param('sssi',$nome,$email,$tipo,$id);} $up->execute(); header('Location: index.php'); exit(); }
$current_page='admin_usuarios'; include '../../configs/header.php';
?>
<main class="main"><div class="container"><h1 class="page-title"><span>Editar Usuário</span></h1><form method="POST" class="card form-grid"><div class="form-group"><label>Nome</label><input name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required></div><div class="form-group"><label>E-mail</label><input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required></div><div class="form-group"><label>Nova senha</label><input type="password" name="senha" placeholder="Deixe em branco para manter"></div><div class="form-group"><label>Tipo</label><select name="tipo"><option value="cliente" <?= $usuario['tipo']=='cliente'?'selected':'' ?>>Cliente</option><option value="admin" <?= $usuario['tipo']=='admin'?'selected':'' ?>>Administrador</option></select></div><div class="form-group full"><button type="submit">Salvar</button></div></form></div></main><?php include '../../configs/footer.php'; ?>
