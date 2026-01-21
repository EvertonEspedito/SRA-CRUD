<?php
include "includes/conexao.php";
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = $conn->query("SELECT * FROM usuarios WHERE email='$email'");

if ($sql->num_rows == 1) {
    $u = $sql->fetch_assoc();

    // VERIFICA A SENHA CRIPTOGRAFADA
    if (password_verify($senha, $u['senha'])) {

        $_SESSION['usuario_id'] = $u['id'];
        $_SESSION['usuario_nome'] = $u['nome'];
        $_SESSION['usuario_tipo'] = $u['tipo'];

        header("Location: index.php");
        exit;
    }
}

echo "Login inválido";
