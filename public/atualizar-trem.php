<?php

include "../infra/conn.php";
$id = $_POST["id"];
$peso = $_POST["peso"];
$quantidade_vagoes = $_POST["quantidade_vagoes"];
$id_usuarios = $_POST["id_usuarios"];
$id_rota = $_POST["id_rota"];

if ($id_rota === "") {
    $id_rota = NULL;
}

$sql = "UPDATE trens SET peso=?, quantidade_vagoes=?, id_usuarios=?, id_rota=? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("diiii", $peso, $quantidade_vagoes, $id_usuarios, $id_rota, $id);
$stmt->execute();

header("Location: gestao-trem.php?sucesso=trem");

?>