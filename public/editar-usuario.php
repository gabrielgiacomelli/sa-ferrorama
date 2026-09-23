<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if (!isset($_GET["id"])) {
    die("ID do usuário não informado.");
}

$id = (int) $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$usuario) {
    die("Usuário não encontrado.");
}

/* ATUALIZAR */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirm_senha = $_POST["confirm_senha"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nascimento = $_POST["data_nascimento"];
    $cep = $_POST["cep"];
    $complemento = $_POST["complemento"];
    $telefone = $_POST["telefone"];

    if ($senha !== $confirm_senha) {

        $mensagem = "As senhas não são iguais.";
        $tipoMensagem = "erro";

    } else {

        $sql = "UPDATE usuarios SET
                email = ?,
                senha = ?,
                confirm_senha = ?,
                nome = ?,
                cpf = ?,
                data_nascimento = ?,
                cep = ?,
                complemento = ?,
                telefone = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssssssssi",
            $email,
            $senha,
            $confirm_senha,
            $nome,
            $cpf,
            $data_nascimento,
            $cep,
            $complemento,
            $telefone,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {

            $mensagem = "Usuário atualizado com sucesso!";
            $tipoMensagem = "sucesso";

            $usuario = [
                "email" => $email,
                "senha" => $senha,
                "confirm_senha" => $confirm_senha,
                "nome" => $nome,
                "cpf" => $cpf,
                "data_nascimento" => $data_nascimento,
                "cep" => $cep,
                "complemento" => $complemento,
                "telefone" => $telefone
            ];

        } else {

            $mensagem = "Erro ao atualizar usuário.";
            $tipoMensagem = "erro";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css?v=1.1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>
    
    <div id="editar-usuarios">

    <main class="editar-usuarios-main">

        <h1>Editar Usuário</h1>

        <div class="editar-usuarios-container">

            <div class="editar-usuarios-card">

                <form method="POST">

                    <div class="editar-usuarios-colunas">

                        <!-- PRIMEIRA COLUNA -->

                        <div class="editar-usuarios-coluna">

                            <div class="editar-usuarios-campo">

                                <label for="usuario-email">Email</label>

                                <input type="email" id="usuario-email" name="email" value="<?php echo $usuario['email']; ?>" required>
                            </div>

                            <div class="editar-usuarios-campo">

                                <label for="usuario-senha">Senha</label>

                                <input type="password" id="usuario-senha" name="senha" value="<?php echo $usuario['senha']; ?>" required>
                            </div>

                            <div class="editar-usuarios-campo">

                                <label for="usuario-confirm-senha">Confirmar Senha</label>
                                
                                <input type="password" id="usuario-confirm-senha" name="confirm_senha" value="<?php echo $usuario['confirm_senha']; ?>" required>
                            </div>

                        </div>

                        <!-- SEGUNDA COLUNA -->

                        <div class="editar-usuarios-coluna">

                            <div class="editar-usuarios-campo">

                                <label for="usuario-nome">Nome Completo</label>

                                <input type="text" id="usuario-nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
                            </div>

                            <div class="editar-usuarios-campo">

                                <label for="usuario-cpf">CPF</label>

                                <input type="text" id="usuario-cpf" name="cpf" value="<?php echo $usuario['cpf']; ?>" required>
                            </div>

                            <div class="editar-usuarios-campo">

                                <label for="usuario-data">Data de Nascimento</label>

                                <input type="date" id="usuario-data" name="data_nascimento" value="<?php echo $usuario['data_nascimento']; ?>" required>
                            </div>

                        </div>

                        <!-- TERCEIRA COLUNA -->

                        <div class="editar-usuarios-coluna">

                            <div class="editar-usuarios-campo">

                                <label for="usuario-cep">CEP</label>

                                <input type="text" id="usuario-cep" name="cep" value="<?php echo $usuario['cep']; ?> "required>

                            </div>

                            <div class="editar-usuarios-campo">

                                <label for="usuario-complemento">Complemento</label>

                                <input type="text" id="usuario-complemento" name="complemento" value="<?php echo $usuario['complemento']; ?>">

                            </div>

                            <div class="editar-usuarios-campo">

                                <label for="usuario-telefone">Telefone</label>

                                <input type="text" id="usuario-telefone" name="telefone" value="<?php echo $usuario['telefone']; ?>" required>

                            </div>
                        </div>
                    </div>

                    <div class="editar-usuarios-botao">

                        <button type="submit">
                            Salvar Alterações
                        </button>

                    </div>

                    <div class="editar-usuarios-botao-voltar">

                        <a href="gestao-usuarios.php">
                            Voltar
                        </a>

                    </div>

                    <?php if ($mensagem !== ""): ?>

                        <div class="cadastro-mensagem <?php echo $tipoMensagem; ?>">
                            <?php echo htmlspecialchars($mensagem); ?>
                        </div>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </main>

</div>
</body>