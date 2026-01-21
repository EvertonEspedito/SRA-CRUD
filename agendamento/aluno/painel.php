<?php
include "../includes/header.php";
include "../includes/conexao.php";
include "../includes/protecao.php";

if ($_SESSION['usuario_tipo'] != 'aluno') exit;

$id = $_SESSION['usuario_id'];
?>
<link rel="stylesheet" href="/agendamento/css/style.css"> <!-- Inclua o estilo principal -->
<link rel="stylesheet" href="/agendamento/css/aluno.css"> <!-- Estilo específico para aluno -->


<h2>Painel do Aluno</h2>

<a href="agendar.php" class="btn-agendar">+ Novo Agendamento</a>

<h3>Meus Agendamentos</h3>

<table>
    <tr>
        <th>Professor</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Status</th>
        <th>Detalhes</th>
        <th>Ação</th>
    </tr>

<?php
$r = $conn->query("
    SELECT a.*, u.nome AS professor
    FROM agendamentos a
    JOIN usuarios u ON u.id = a.professor_id
    WHERE a.aluno_id = $id
    ORDER BY a.data DESC, a.hora DESC
");

while ($a = $r->fetch_assoc()):
?>

<tr>
    <td><?= $a['professor']; ?></td>
    <td><?= date('d/m/Y', strtotime($a['data'])); ?></td>
    <td><?= $a['hora']; ?></td>
    <td>
        <?php
            if ($a['status'] == 'pendente')
                echo "<span class='status pendente'>Pendente</span>";
            elseif ($a['status'] == 'aceito')
                echo "<span class='status aprovado'>Aprovado</span>";
            elseif ($a['status'] == 'recusado')
                echo "<span class='status rejeitado'>Recusado</span>";
        ?>
    </td>
    <td><!--Motivo da recusa-->
        <?php
            if ($a['status'] == 'recusado' && !empty($a['motivo_recusa'])) {
                echo "<strong>Motivo da recusa:</strong> " . htmlspecialchars($a['motivo_recusa']);
            }
        ?>
    </td>
    <td>
        <?php if ($a['status'] == 'pendente'): ?>
            <a class="btn-editar" href="editar.php?id=<?= $a['id'] ?>">Editar</a> |
            <a class="btn-cancelar-agendamento"href="cancelar.php?id=<?= $a['id']; ?>"
               onclick="return confirm('Deseja cancelar este agendamento?')">
               Cancelar
            </a>
        <?php else: ?>
            —
        <?php endif; ?>
    </td>
 
</tr>

<?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>