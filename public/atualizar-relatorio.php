<?php

include "../infra/conn.php";
$id = $_POST["id"];
$conteudo = $_POST["conteudo"];

$sql = "UPDATE relatorios SET conteudo=? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $conteudo, $id);
$stmt->execute();

header("Location: gestao-relatorios.php?sucesso=relatorio");

?>