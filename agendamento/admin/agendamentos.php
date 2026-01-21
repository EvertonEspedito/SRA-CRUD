<?php
include('../includes/auth.php');
include('../includes/conexao.php');
include('../includes/header.php');

$sql = "
SELECT a.id, u1.nome AS aluno, u2.nome AS professor, a.data, a.hora, a.status
FROM agendamentos a
JOIN usuarios u1 ON a.aluno_id = u1.id
JOIN usuarios u2 ON a.professor_id = u2.id
";

$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->
<link rel="stylesheet" href="/agendamento/css/agendamentos.css"> <!-- Estilo específico para agendamentos -->

<h2>Todos os Agendamentos</h2>

<table>
<tr>
    <th>Aluno</th>
    <th>Professor</th>
    <th>Data</th>
    <th>Hora</th>
    <th>Status</th>
    <th>Ações</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $row['aluno'] ?></td>
    <td><?= $row['professor'] ?></td>
    <td><?= $row['data'] ?></td>
    <td><?= $row['hora'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <a href="status.php?id=<?= $row['id'] ?>&s=aprovado">Aprovar</a> |
        <a href="status.php?id=<?= $row['id'] ?>&s=recusado">Recusar</a> |
        <a href="excluir.php?id=<?= $row['id'] ?>">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include('../includes/footer.php'); ?>
