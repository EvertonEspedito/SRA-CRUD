<?php
$conn = new mysqli("localhost", "root", "", "agendamento");
if ($conn->connect_error) {
    die("Erro de conexão");
}
