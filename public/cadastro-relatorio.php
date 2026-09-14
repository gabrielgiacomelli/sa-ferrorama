<?php
include "../infra/conn.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$conteudo = $_POST["conteudo"];



$sql = "INSERT INTO usuarios(conteudo) VALUES ('$conteudo')";

mysqli_query($conn, $sql);

}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Relatórios</title>

    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>

<main>

<form method = "POST">

<label for="conteudo"></label>
<input type="text" name ="conteudo">
</input>

<button> Cadastrar </button>

</form>

</main>

</body>

</html>