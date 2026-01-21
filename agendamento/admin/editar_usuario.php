<?php
include "../includes/header.php";
include "../includes/conexao.php";
include "../includes/protecao.php";

if ($_SESSION['usuario_tipo'] != 'admin') exit;

$id = $_GET['id'];

$u = $conn->query("SELECT * FROM usuarios WHERE id=$id")->fetch_assoc();

if ($_POST) {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $tipo  = $_POST['tipo'];

    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $conn->query("UPDATE usuarios SET nome='$nome', email='$email', senha='$senha', tipo='$tipo' WHERE id=$id");
    } else {
        $conn->query("UPDATE usuarios SET nome='$nome', email='$email', tipo='$tipo' WHERE id=$id");
    }

    header("Location: usuarios.php");
}
?>


<link rel="stylesheet" href="/agendamento/css/usuarios.css"> <!-- Estilo específico para usuários -->
<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->

<h2>Editar Usuário</h2>

<div class="form-box">
<form method="POST">
    <input name="nome" value="<?= $u['nome'] ?>" required>
    <input name="email" value="<?= $u['email'] ?>" required>
    <input name="senha" type="password" placeholder="Nova senha (opcional)">
    <select name="tipo">
        <option <?= $u['tipo']=='aluno'?'selected':'' ?>>aluno</option>
        <option <?= $u['tipo']=='professor'?'selected':'' ?>>professor</option>
        <option <?= $u['tipo']=='admin'?'selected':'' ?>>admin</option>
    </select>
    <button>Salvar Alterações</button>
</form>
</div>

<?php include "../includes/footer.php"; ?>
