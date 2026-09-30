<?php

include "../infra/conn.php";

// Recebe os dados
$id = $_POST["id"] ?? "";
$nome = trim($_POST["nome"] ?? "");
$instalacao = trim($_POST["instalacao"] ?? "");
$funcao = trim($_POST["funcao"] ?? "");
$zona = trim($_POST["zona"] ?? "");
$status = trim($_POST["status"] ?? "");


// ==============================
// VALIDAÇÃO DO ID
// ==============================

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    header("Location: gestao-sensores.php?erro=sensor");
    exit;
}


// ==============================
// VALIDAÇÃO DOS CAMPOS
// ==============================

if (
    empty($nome) ||
    empty($instalacao) ||
    empty($funcao) ||
    empty($zona) ||
    empty($status)
) {
    header("Location: gestao-sensores.php?erro=campos");
    exit;
}


// ==============================
// VALIDAÇÃO DA INSTALAÇÃO
// ==============================

$instalacoesPermitidas = [
    "Trem",
    "Ferrovia"
];

if (!in_array($instalacao, $instalacoesPermitidas, true)) {
    header("Location: gestao-sensores.php?erro=instalacao");
    exit;
}


// ==============================
// VALIDAÇÃO DA FUNÇÃO
// ==============================

$funcoesPermitidas = [
    "Velocidade",
    "Temperatura",
    "Falhas",
    "Gasolina"
];

if (!in_array($funcao, $funcoesPermitidas, true)) {
    header("Location: gestao-sensores.php?erro=funcao");
    exit;
}


// ==============================
// VALIDAÇÃO DO STATUS
// ==============================

$statusPermitidos = [
    "Ativo",
    "Inativo"
];

if (!in_array($status, $statusPermitidos, true)) {
    header("Location: gestao-sensores.php?erro=status");
    exit;
}


// ==============================
// ATUALIZA O SENSOR
// ==============================

$sql = "UPDATE sensores
        SET nome = ?,
            instalacao = ?,
            funcao = ?,
            zona = ?,
            status = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    header("Location: gestao-sensores.php?erro=atualizar");
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "sssssi",
    $nome,
    $instalacao,
    $funcao,
    $zona,
    $status,
    $id
);


// ==============================
// EXECUTA
// ==============================

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: gestao-sensores.php?sucesso=sensor");
    exit;

} else {

    mysqli_stmt_close($stmt);

    header("Location: gestao-sensores.php?erro=atualizar");
    exit;
}

?>