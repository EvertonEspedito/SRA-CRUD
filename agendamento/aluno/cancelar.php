<?php
include "../includes/conexao.php";
include "../includes/protecao.php";

if ($_SESSION['usuario_tipo'] != 'aluno') exit;

$id = $_GET['id'];
$aluno = $_SESSION['usuario_id'];

$conn->query("
    DELETE FROM agendamentos
    WHERE id = $id AND aluno_id = $aluno AND status = 'pendente'
");

header("Location: painel.php");
