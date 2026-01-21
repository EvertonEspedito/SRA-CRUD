<?php
session_start();
include "../includes/conexao.php";
include "../includes/protecao.php";

$id = $_POST['id'] ?? $_GET['id'];
$status = $_POST['s'] ?? $_GET['s'];
$motivo = $_POST['motivo'] ?? null;

if ($status == 'recusado' && $motivo) {
    $stmt = $conn->prepare("UPDATE agendamentos SET status=?, motivo_recusa=? WHERE id=?");
    $stmt->bind_param("ssi", $status, $motivo, $id);
} else {
    $stmt = $conn->prepare("UPDATE agendamentos SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
}

$stmt->execute();
header("Location: painel.php");
