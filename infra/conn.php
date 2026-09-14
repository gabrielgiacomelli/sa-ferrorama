<?php

$host = "localhost";
$user = "root";
$password = "root";
$banco = "sa_ferrorama_db";

$conn =  new mysqli($host, $user, $password, $banco);

if ($conn->connect_error) {
    die("Erro na conexão com o banco " . $conn->connect_error);
};

$conn->set_charset("utf8mb4");
?>