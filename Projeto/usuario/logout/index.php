<?php
session_start();
session_destroy();
header('Location: /Projeto/usuario/login/index.php');
exit();
