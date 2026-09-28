<?php

include "../infra/conn.php";
$id = $_POST["id"];
$nome = $_POST["nome"];
$saida = $_POST["saida"];
$destino = $_POST["destino"];

$sql = "UPDATE rotas SET nome=?, saida=?, destino=? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $nome, $saida, $destino, $id);
$stmt->execute();

header("Location: gestao-rota.php?sucesso=rota");

?>