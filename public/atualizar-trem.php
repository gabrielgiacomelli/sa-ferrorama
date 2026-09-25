<?php

include "../infra/conn.php";
$id = $_POST["id"];
$peso = $_POST["peso"];
$quantidade = $_POST["quantidade"];
$proprietario = $_POST["proprietario"];

$sql = "UPDATE trens SET peso=?, quantidade=?, proprietario=? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("diii", $peso, $quantidade, $proprietario, $id);
$stmt->execute();

header("Location: gestao-relatorios.php?sucesso=trem");

?>