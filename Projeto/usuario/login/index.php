<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $stmt = $conn->prepare('SELECT id, nome, email, senha, tipo FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];
        header('Location: /Projeto/usuario/destaques/index.php');
        exit();
    }
    $erro = 'E-mail ou senha inválidos.';
}
$current_page = 'login';
include '../../configs/header.php';
?>
<main class="main"><div class="container">
    <h1 class="page-title"><span>Login</span></h1>
    <?php if ($erro): ?><div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <form method="POST" class="card" style="max-width:480px;">
        <div class="form-group"><label>E-mail</label><input type="email" name="email" required></div>
        <div class="form-group"><label>Senha</label><input type="password" name="senha" required></div>
        <button type="submit">Entrar</button>
        <p style="margin-top:1.5rem;color:var(--muted);">Usuário admin inicial: admin@bytestore.com / 123456</p>
    </form>
</div></main>
<?php include '../../configs/footer.php'; ?>
