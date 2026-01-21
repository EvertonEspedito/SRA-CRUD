<?php
include('../includes/conexao.php');

$id = $_GET['id'];
$status = $_GET['s'];

mysqli_query($conn, "UPDATE agendamentos SET status='$status' WHERE id=$id");

header("Location: agendamentos.php");
