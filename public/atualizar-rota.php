<?php

include "../infra/conn.php";
$id = $_POST["id"];
$nome = $_POST["nome"];
$saida = $_POST["saida"];
$destino = $_POST["destino"];
$id_usuarios = $_POST["id_usuarios"];

$sql = "UPDATE rotas SET nome=?, saida=?, destino=?, id_usuarios=? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $nome, $saida, $destino, $id_usuarios, $id);
$stmt->execute();

header("Location: gestao-trem.php?sucesso=rota");

?>