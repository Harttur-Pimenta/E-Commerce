<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$current_page='admin_usuarios';
$usuarios=$conn->query('SELECT id,nome,email,tipo,criado_em FROM usuarios ORDER BY id DESC');
include '../../configs/header.php';
?>
<main class="main"><div class="container">
    <div class="page-header"><h1 class="page-title"><span>Usuários</span></h1><a class="btn btn-primary" href="cadastrar.php">+ Usuário</a></div>
    <div class="table-wrapper"><table>
        <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Tipo</th><th>Cadastro</th><th>Ações</th></tr></thead>
        <tbody><?php while($u=$usuarios->fetch_assoc()): ?>
            <tr><td><?= $u['id'] ?></td><td><?= htmlspecialchars($u['nome']) ?></td><td><?= htmlspecialchars($u['email']) ?></td><td><?= htmlspecialchars($u['tipo']) ?></td><td><?= date('d/m/Y', strtotime($u['criado_em'])) ?></td><td><a class="btn btn-secondary btn-sm" href="editar.php?id=<?= $u['id'] ?>">Editar</a> <a class="btn-delete" href="excluir.php?id=<?= $u['id'] ?>" onclick="return confirm('Excluir usuário?')">Excluir</a></td></tr>
            <?php endwhile; ?>
        </tbody>
    </table></div>
</div></main>
<?php include '../../configs/footer.php'; ?>
