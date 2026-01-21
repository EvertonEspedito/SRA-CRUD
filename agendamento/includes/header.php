<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Agendamentos Acadêmicos</title>


    <!-- CSS DO HEADER -->
    <link rel="stylesheet" href="/agendamento/css/header.css">
    
</head>
<body>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="/agendamento/index.php">📅 Sistema de Agendamentos Acadêmicos</a>
        </div>

        <nav class="menu">
            <!-- Se o usuario estiver deslogado e clicar em inicio, vai para home.php, caso o contrario vai para o painel -->
            <?php if(!isset($_SESSION['usuario_id'])): ?>
                <a href="/agendamento/home.php">Inicio</a>
            <?php else: ?>
                <a href="/agendamento/<?php echo strtolower($_SESSION['usuario_tipo']); ?>/painel.php">Painel</a>
            <?php endif; ?>
        

            <?php if(isset($_SESSION['usuario_id'])): ?>
                <span class="user-info">
                    <?= $_SESSION['usuario_nome'] ?>
                    <small>(<?= $_SESSION['usuario_tipo'] ?>)</small>
                </span>
                <a href="/agendamento/logout.php" class="btn-logout">Sair</a>
            <?php else: ?>
                <a href="/agendamento/login.php" class="btn-login-header">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="container">
