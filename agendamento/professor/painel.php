<?php
include "../includes/header.php";
include "../includes/conexao.php";
include "../includes/protecao.php";

$id = $_SESSION['usuario_id'];

$r = $conn->query("
    SELECT a.*, u.nome AS aluno
    FROM agendamentos a
    JOIN usuarios u ON u.id = a.aluno_id
    WHERE a.professor_id = $id
    ORDER BY a.data, a.hora
");
?>

<link rel="stylesheet" href="/agendamento/css/style.css">

<style>
.painel-container {
    max-width: 900px;
    margin: auto;
}

.card {
    background: #fff;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,.1);
}

.card p {
    margin: 5px 0;
}

.acoes {
    margin-top: 10px;
}

.acoes a,
.acoes button {
    padding: 6px 10px;
    margin-right: 5px;
    border-radius: 5px;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.aceitar {
    background: #2ecc71;
    color: white;
}

.recusar {
    background: #e74c3c;
    color: white;
}



textarea {
    width: 100%;
    margin-top: 8px;
    padding: 5px;
}
</style>

<div class="painel-container">
    <h2>Painel do Professor – Solicitações</h2>

    <?php while ($a = $r->fetch_assoc()): ?>
        <div class="card">
            <p><strong>Aluno:</strong> <?= $a['aluno'] ?></p>
            <p><strong>Data:</strong> <?= $a['data'] ?></p>
            <p><strong>Hora:</strong> <?= $a['hora'] ?></p>
            <p><strong>Status:</strong> <?= $a['status'] ?></p>

            <div class="acoes">
                <a class="aceitar" href="acao.php?id=<?= $a['id'] ?>&s=aceito">Aceitar</a>

                <!-- RECUSA COM MOTIVO -->
                <form action="acao.php" method="post" style="margin-top:10px;">
                    <input type="hidden" name="id" value="<?= $a['id'] ?>">
                    <input type="hidden" name="s" value="recusado">

                    <textarea name="motivo" placeholder="Informe o motivo da recusa..." required></textarea>

                    <button class="recusar" type="submit">Recusar com motivo</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>

    <hr>

    <!-- RELATÓRIO -->
    <h3>Relatório Geral</h3>
    <a href="relatorio.php" class="btn-relatorio">📊 Relatório</a>

</div>

<?php include "../includes/footer.php"; ?>
