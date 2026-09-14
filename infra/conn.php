<?php

$host = "localhost";
$user = "root";
<<<<<<< HEAD
$password = "root";
$banco = "sa_ferrorama_db";

$conn =  new mysqli($host, $user, $password, $banco);
=======
$banco = "sa_ferrorama_db";

$conn = @new mysqli($host, $user, "", $banco, 3307);
>>>>>>> b2dba9e004af6e50f4c48086d91c0cb7145945f6


if ($conn->connect_error){
    $conn = @new mysqli($host, $user, "root", $banco);
    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco " . $conn->connect_error);
    };
}

$conn->set_charset("utf8mb4");
?>