<?php include "includes/header.php"; ?>

<!-- CSS global -->
<link rel="stylesheet" href="/agendamento/css/style.css">

<!-- CSS específico do login -->
<link rel="stylesheet" href="/agendamento/css/login.css">

<div class="login-wrapper">
    <div class="login-card">
        <h2>Bem-vindo 👋</h2>
        <p>Faça login para acessar o sistema de agendamentos</p>

        <form method="POST" action="valida_login.php">
            <label for="email">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                placeholder="Digite seu email" 
                required
            >

            <label for="senha">Senha</label>
            <input 
                type="password" 
                name="senha" 
                id="senha"
                placeholder="Digite sua senha" 
                required
            >

            <button type="submit" class="btn-login">
                Entrar
            </button>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
