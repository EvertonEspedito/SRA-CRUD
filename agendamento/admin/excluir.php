<?php
include('../includes/conexao.php');

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM agendamentos WHERE id=$id");

header("Location: agendamentos.php");
