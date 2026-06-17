<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
if ($_SERVER['REQUEST_METHOD']==='POST') { $nome=$_POST['nome']; $email=$_POST['email']; $senha=password_hash($_POST['senha'], PASSWORD_DEFAULT); $tipo=$_POST['tipo']; $stmt=$conn->prepare('INSERT INTO usuarios (nome,email,senha,tipo) VALUES (?,?,?,?)'); $stmt->bind_param('ssss',$nome,$email,$senha,$tipo); $stmt->execute(); header('Location: index.php'); exit(); }
$current_page='admin_usuarios'; include '../../configs/header.php';
?>
<main class="main"><div class="container"><h1 class="page-title"><span>Cadastrar Usuário</span></h1><form method="POST" class="card form-grid"><div class="form-group"><label>Nome</label><input name="nome" required></div><div class="form-group"><label>E-mail</label><input type="email" name="email" required></div><div class="form-group"><label>Senha</label><input type="password" name="senha" required></div><div class="form-group"><label>Tipo</label><select name="tipo"><option value="cliente">Cliente</option><option value="admin">Administrador</option></select></div><div class="form-group full"><button type="submit">Salvar</button></div></form></div></main><?php include '../../configs/footer.php'; ?>
