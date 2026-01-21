<?php include "../includes/header.php"; ?>
<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->
<link rel="stylesheet" href="/agendamento/css/painel.css"> <!-- Estilo específico para o painel administrativo -->

<h2>Painel Administrativo</h2>

<div class="painel-admin">

    <div class="card">
        <span>👥</span>
        <h3>Usuários</h3>
        <p>Gerencie alunos, professores e administradores.</p>
        <a href="usuarios.php">Gerenciar</a>
    </div>

    <div class="card">
        <span>📅</span>
        <h3>Agendamentos</h3>
        <p>Visualize e controle todos os agendamentos.</p>
        <a href="agendamentos.php">Ver Agendamentos</a>
    </div>

</div>

    <!-- RELATÓRIO -->
    <h3>Relatório Geral</h3>
    <a href="relatorio.php" class="btn-relatorio">📊 Relatório</a>

</div>

<?php include "../includes/footer.php"; ?>
