<?php
include "../includes/conexao.php";
include "../includes/protecao.php";

$tipo = $_SESSION['usuario_tipo'];
$professor_id = $_SESSION['usuario_id'];

// Apenas professor
if ($tipo != 'professor') {
    header("Location: /agendamento/login.php");
    exit;
}

// Filtros
$data_inicio = $_GET['inicio'] ?? '';
$data_fim    = $_GET['fim'] ?? '';

// SQL
$sql = "
SELECT 
    a.data,
    a.hora,
    a.status,
    a.motivo_recusa,
    u.nome AS aluno
FROM agendamentos a
JOIN usuarios u ON u.id = a.aluno_id
WHERE a.professor_id = $professor_id
";

// Filtro por data
if ($data_inicio && $data_fim) {
    $sql .= " AND a.data BETWEEN '$data_inicio' AND '$data_fim'";
}

$sql .= " ORDER BY a.data DESC, a.hora DESC";

// =====================
// DOWNLOAD CSV
// =====================
if (isset($_GET['download']) && $_GET['download'] == 1) {

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=relatorio_professor.csv');

    $output = fopen('php://output', 'w');

    fputcsv($output, [
        'Aluno',
        'Data',
        'Hora',
        'Status',
        'Motivo da Recusa'
    ]);

    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
        fputcsv($output, [
            $row['aluno'],
            date('d/m/Y', strtotime($row['data'])),
            $row['hora'],
            ucfirst($row['status']),
            $row['motivo_recusa']
        ]);
    }

    fclose($output);
    exit;
}

// =====================
// TELA
// =====================
include "../includes/header.php";

$result = $conn->query($sql);

// Contadores
$aceitos = 0;
$recusados = 0;
$pendentes = 0;
$dados = [];

while ($row = $result->fetch_assoc()) {
    $dados[] = $row;

    if ($row['status'] == 'aceito') $aceitos++;
    if ($row['status'] == 'recusado') $recusados++;
    if ($row['status'] == 'pendente') $pendentes++;
}

$total = count($dados);

// Análises
$taxa_aceite = $total ? round(($aceitos / $total) * 100, 1) : 0;
$taxa_recusa = $total ? round(($recusados / $total) * 100, 1) : 0;

// Diagnóstico
$diagnostico = "Gestão equilibrada de agendamentos.";
if ($taxa_recusa > 40) {
    $diagnostico = "Muitas recusas. Avalie horários ou critérios.";
}
if ($taxa_aceite > 70) {
    $diagnostico = "Excelente desempenho no atendimento.";
}

// Gráfico
$max = max($aceitos, $pendentes, $recusados, 1);

function alturaBarra($valor, $max) {
    if ($valor == 0) return 20;
    return ($valor / $max) * 180 + 20;
}
?>

<link rel="stylesheet" href="/agendamento/css/style.css">
<link rel="stylesheet" href="/agendamento/css/relatorio.css">

<h2>📊 Relatório do Professor</h2>

<form method="GET" class="form-relatorio">
    <label>Data inicial</label>
    <input type="date" name="inicio" value="<?= $data_inicio ?>">

    <label>Data final</label>
    <input type="date" name="fim" value="<?= $data_fim ?>">

    <button class="btn">Filtrar</button>
</form>

<div style="margin: 15px 0;">
    <a href="?inicio=<?= $data_inicio ?>&fim=<?= $data_fim ?>&download=1"
       class="btn-relatorio">
        ⬇️ Baixar CSV
    </a>

    <button class="btn-pdf" onclick="window.print()">
        📄 Baixar PDF
    </button>
</div>

<!-- CARDS -->
<div class="cards">
    <div class="card">
        <h4>Total</h4>
        <p><?= $total ?></p>
    </div>

    <div class="card aceito">
        <h4>Aceitos</h4>
        <p><?= $aceitos ?></p>
    </div>

    <div class="card pendente">
        <h4>Pendentes</h4>
        <p><?= $pendentes ?></p>
    </div>

    <div class="card recusado">
        <h4>Recusados</h4>
        <p><?= $recusados ?></p>
    </div>
</div>

<!-- GRÁFICO -->
<h3>Análise Visual</h3>

<div class="grafico">
    <div class="coluna">
        <div class="barra aceito" style="height: <?= alturaBarra($aceitos, $max) ?>px">
            <?= $aceitos ?>
        </div>
        <span>Aceitos</span>
    </div>

    <div class="coluna">
        <div class="barra pendente" style="height: <?= alturaBarra($pendentes, $max) ?>px">
            <?= $pendentes ?>
        </div>
        <span>Pendentes</span>
    </div>

    <div class="coluna">
        <div class="barra recusado" style="height: <?= alturaBarra($recusados, $max) ?>px">
            <?= $recusados ?>
        </div>
        <span>Recusados</span>
    </div>
</div>

<p><strong>Taxa de aceite:</strong> <?= $taxa_aceite ?>%</p>
<p><strong>Taxa de recusa:</strong> <?= $taxa_recusa ?>%</p>
<p><strong>Diagnóstico:</strong> <?= $diagnostico ?></p>

<!-- TABELA -->
<table>
    <tr>
        <th>Aluno</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Status</th>
        <th>Motivo da Recusa</th>
    </tr>

<?php foreach ($dados as $r): ?>
<tr>
    <td><?= $r['aluno'] ?></td>
    <td><?= date('d/m/Y', strtotime($r['data'])) ?></td>
    <td><?= $r['hora'] ?></td>
    <td>
        <span class="status <?= $r['status'] ?>">
            <?= ucfirst($r['status']) ?>
        </span>
    </td>
    <td><?= $r['motivo_recusa'] ?: '-' ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php include "../includes/footer.php"; ?>
