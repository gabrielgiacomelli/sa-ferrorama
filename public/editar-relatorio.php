<?php

include "../infra/conn.php";

// busca relatório
$id = $_GET["id"];
$sql = "SELECT * FROM relatorios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$relatorio = mysqli_fetch_assoc($resultado);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relatório</title>
</head>
<body>
    
</body>
</html>