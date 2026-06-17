<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../../configs/banco.php';
require_once '../../configs/auth.php';
exigir_admin();
$id=(int)($_GET['id']??0); if($id !== (int)($_SESSION['usuario_id']??0)){ $stmt=$conn->prepare('DELETE FROM usuarios WHERE id=?'); $stmt->bind_param('i',$id); $stmt->execute(); }
header('Location: index.php'); exit();
