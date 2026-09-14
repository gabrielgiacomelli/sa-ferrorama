<?php

$host = "localhost";
$user = "root";
$banco = "sa_ferrorama_db";

$conn = @new mysqli($host, $user, "", $banco, 3307);


if ($conn->connect_error){
    $conn = @new mysqli($host, $user, "root", $banco);
    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco " . $conn->connect_error);
    };
}

$conn->set_charset("utf8mb4");
?>