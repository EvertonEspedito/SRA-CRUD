<?php
include "../includes/header.php";
include "../includes/conexao.php";
include "../includes/protecao.php";

// Garante que apenas alunos acessem
if ($_SESSION['usuario_tipo'] != 'aluno') {
    header("Location: /agendamento/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $aluno_id     = $_SESSION['usuario_id'];
    $professor_id = (int) $_POST['professor'];
    $data         = $_POST['data'];
    $hora         = $_POST['hora'];

    $sql = "
        INSERT INTO agendamentos 
        (aluno_id, professor_id, data, hora, status)
        VALUES 
        ($aluno_id, $professor_id, '$data', '$hora', 'pendente')
    ";

    $conn->query($sql);

    // Evita duplicação e melhora UX
    header("Location: painel.php?msg=ok");
    exit;
}
?>

<link rel="stylesheet" href="/agendamento/css/style.css">
<link rel="stylesheet" href="/agendamento/css/aluno.css">

<h2>Novo Agendamento</h2>

<form method="POST" class="form-agendamento">

    <label>Professor</label>
    <select name="professor" required>
        <option value="">Selecione um professor</option>
        <?php
        $r = $conn->query("SELECT id, nome FROM usuarios WHERE tipo='professor'");
        while ($p = $r->fetch_assoc()):
        ?>
            <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
        <?php endwhile; ?>
    </select>

    <label>Data</label>
    <input type="date" name="data" required>

    <label>Hora</label>
    <input type="time" name="hora" required>

    <button class="btn btn-agendar">Agendar</button>
</form>

<?php include "../includes/footer.php"; ?>
