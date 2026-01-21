<?php
include "../includes/header.php";
include "../includes/conexao.php";
include "../includes/protecao.php";

if ($_SESSION['usuario_tipo'] != 'admin') exit;

// CADASTRAR
if ($_POST) {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo  = $_POST['tipo'];

    $conn->query("INSERT INTO usuarios (nome,email,senha,tipo)
                  VALUES ('$nome','$email','$senha','$tipo')");
}
?>

<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->
<link rel="stylesheet" href="/agendamento/css/usuarios.css"> <!-- Estilo específico para usuários -->
<h2>Gerenciar Usuários</h2>

<div class="form-box">
    <form method="POST">
        <input name="nome" placeholder="Nome" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>
        <select name="tipo">
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
            <option value="admin">Admin</option>
        </select>
        <button>Cadastrar Usuário</button>
    </form>
</div>

<table>
<tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Tipo</th>
    <th>Ações</th>
</tr>

<?php
$r = $conn->query("SELECT * FROM usuarios");
while ($u = $r->fetch_assoc()):
?>
<tr>
    <td><?= $u['nome'] ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['tipo'] ?></td>
    <td>
        <a class="btn-edit" href="editar_usuario.php?id=<?= $u['id'] ?>">Editar</a>
        <a class="btn-del" href="?del=<?= $u['id'] ?>"
           onclick="return confirm('Deseja excluir?')">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php
if (isset($_GET['del'])) {
    $conn->query("DELETE FROM usuarios WHERE id=".$_GET['del']);
    header("Location: usuarios.php");
}
include "../includes/footer.php";
?>