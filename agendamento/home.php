<?php require 'includes/header.php'; ?>
<link rel="stylesheet" href="/agendamento/css/home.css">
<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->


<section class="hero">
    <div class= "layer">
        <div class="hero-content">
            <h1>Sistema de Agendamentos Acadêmicos</h1>
            <p>
                Organize seus horários, gerencie atendimentos e facilite o agendamento
                de forma rápida, simples e segura.
            </p>

            <div class="hero-buttons">
                <a href="login.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div> <!-- Fechando a div container do header.php -->    
</section>


<section class="features">
    <h2>O que você pode fazer</h2>

    <div class="features-grid">
        <div class="feature-card">
            <h3>📅 Agendamentos</h3>
            <p>Crie, edite e visualize seus horários de forma organizada.</p>
        </div>

        <div class="feature-card">
            <h3>👤 Usuários</h3>
            <p>Controle acessos e tenha um painel exclusivo para cada usuário.</p>
        </div>

        <div class="feature-card">
            <h3>⏱️ Gestão de tempo</h3>
            <p>Evite conflitos de horários e otimize sua rotina.</p>
        </div>

        <div class="feature-card">
            <h3>🔐 Segurança</h3>
            <p>Sistema com autenticação para proteger seus dados.</p>
        </div>
    </div>
</section>


<?php require 'includes/footer.php'; ?>
