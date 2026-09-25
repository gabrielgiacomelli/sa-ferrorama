<?php

include "../infra/conn.php";
$id = $_POST["id"];
$peso = $_POST["peso"];
$quantidade_vagoes = $_POST["quantidade_vagoes"];
$id_usuarios = $_POST["id_usuarios"];

$sql = "UPDATE trens SET peso=?, quantidade_vagoes=?, id_usuarios=? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("diii", $peso, $quantidade_vagoes, $id_usuarios, $id);
$stmt->execute();

header("Location: gestao-relatorios.php?sucesso=trem");

?>