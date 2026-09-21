<?php

include "../infra/conn.php";

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

    $sql = "INSERT INTO usuarios
    (email, senha, confirm_senha, nome, cpf, data_nascimento, cep, complemento, telefone)
    VALUES
    ('$email', '$senha', '$confirm_senha', '$nome', '$cpf', '$data_nascimento', '$cep', '$complemento', '$telefone')";

    mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    
<?php
$paginaAtual = "cadastro";
$submenuAtual = "usuarios";
include("../includes/navbar.php");
?>

<body>

<div id="cadastro-usuarios">

    <main class="cadastro-usuarios-main">

    <h1>Cadastro de usuários</h1>

        <div class="cadastro-usuarios-container">

            <div class="cadastro-usuarios-card">

                <form method="POST">


                    <div class="cadastro-usuarios-colunas">

                        <div class="cadastro-usuarios-coluna">

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-email">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="usuario-email"
                                    name="email"
                                    placeholder="Digite seu email"
                                    required
                                >

                            </div>

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-senha">
                                    Senha
                                </label>

                                <input
                                    type="password"
                                    id="usuario-senha"
                                    name="senha"
                                    placeholder="Digite sua senha"
                                    required
                                >

                            </div>

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-confirm-senha">
                                    Confirmar senha
                                </label>

                                <input
                                    type="password"
                                    id="usuario-confirm-senha"
                                    name="confirm_senha"
                                    placeholder="Confirme sua senha"
                                    required
                                >

                            </div>


                        </div>

                        <div class="cadastro-usuarios-coluna">

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-nome">
                                    Nome Completo
                                </label>

                                <input
                                    type="text"
                                    id="usuario-nome"
                                    name="nome"
                                    placeholder="Digite seu nome completo"
                                    required
                                >

                            </div>

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-cpf">
                                    CPF
                                </label>

                                <input
                                    type="text"
                                    id="usuario-cpf"
                                    name="cpf"
                                    placeholder="Digite seu CPF"
                                    required
                                >

                            </div>

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-data">
                                    Data de Nascimento
                                </label>

                                <input
                                    type="date"
                                    id="usuario-data"
                                    name="data_nascimento"
                                    required
                                >

                            </div>


                        </div>

                        <div class="cadastro-usuarios-coluna">

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-cep">
                                    CEP
                                </label>

                                <input
                                    type="text"
                                    id="usuario-cep"
                                    name="cep"
                                    placeholder="Digite seu CEP"
                                    required
                                >

                            </div>

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-complemento">
                                    Complemento
                                </label>

                                <input
                                    type="text"
                                    id="usuario-complemento"
                                    name="complemento"
                                    placeholder="Digite um complemento"
                                >

                            </div>

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-telefone">
                                    Telefone
                                </label>

                                <input
                                    type="text"
                                    id="usuario-telefone"
                                    name="telefone"
                                    placeholder="Digite seu telefone"
                                    required
                                >

                            </div>


                        </div>

                    </div>

                    <div class="cadastro-usuarios-botao">

                        <button type="submit">
                            Cadastrar
                        </button>

                    </div>


                    <p id="usuario-resultado"></p>

                </form>

            </div>

        </div>

    </main>

</div>


<script src="../scripts/botao-sair.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>