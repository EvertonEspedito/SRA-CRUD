<?php
include "../includes/header.php";
include "../includes/conexao.php";
include "../includes/protecao.php";

if ($_SESSION['usuario_tipo'] != 'aluno') exit;

$id_agendamento = $_GET['id'];
$aluno = $_SESSION['usuario_id'];

// Buscar agendamento
$a = $conn->query("
    SELECT * FROM agendamentos
    WHERE id = $id_agendamento
    AND aluno_id = $aluno
    AND status = 'pendente'
")->fetch_assoc();

if (!$a) {
    echo "<p>Agendamento não encontrado ou não pode ser editado.</p>";
    include "../includes/footer.php";
    exit;
}

// Professores
$professores = $conn->query("SELECT id, nome FROM usuarios WHERE tipo='professor'");

// Atualizar
if ($_POST) {
    $professor = $_POST['professor'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $conn->query("
        UPDATE agendamentos
        SET professor_id='$professor', data='$data', hora='$hora'
        WHERE id=$id_agendamento
    ");

    header("Location: painel.php");
}
?>

<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->
<link rel="stylesheet" href="/agendamento/css/aluno.css"> <!-- Estilo específico para aluno -->

<h2>Editar Agendamento</h2>

<form method="POST" class="form-editar">
    <label>Professor</label>
    <select name="professor" required>
        <?php while ($p = $professores->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>"
                <?= $p['id']==$a['professor_id']?'selected':'' ?>>
                <?= $p['nome'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Data</label>
    <input type="date" name="data" value="<?= $a['data'] ?>" required>

    <label>Hora</label>
    <input type="time" name="hora" value="<?= $a['hora'] ?>" required>

    <button class="btn-salvar">Salvar Alterações</button>
</form>

<?php include "../includes/footer.php"; ?>
