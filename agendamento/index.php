<?php
session_start();

if (!isset($_SESSION['usuario_tipo'])) {
    header("Location: login.php");
    exit;
}

switch ($_SESSION['usuario_tipo']) {
    case 'admin':
        header("Location: admin/painel.php");
        break;

    case 'professor':
        header("Location: professor/painel.php");
        break;

    case 'aluno':
        header("Location: aluno/painel.php");
        break;

    default:
        header("Location: home.php");
        break;
}

exit;
