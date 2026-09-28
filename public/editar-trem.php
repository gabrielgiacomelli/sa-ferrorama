<?php

include "../infra/conn.php";

// busca trem
$id = $_GET["id"];
$sql = "SELECT * FROM trens WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$trem = mysqli_fetch_assoc($resultado);


// busca usuário proprietário
$sql_usuarios = "SELECT id, nome FROM usuarios";
$resultado_usuarios = mysqli_query($conn, $sql_usuarios);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Trem</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

<main id="cadastro-trens">

    <h2>Editar Trem</h2>

    <div class="cadastro-trens-container">

        <div class="cadastro-trens-card editar-trem-card">

            <form action="atualizar-trem.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $trem["id"]; ?>">

                <div class="cadastro-trens-campo">
                    <label for="peso">
                        Peso total
                    </label>

                    <input
                        type="number"
                        id="peso"
                        name="peso"
                        step="0.01"
                        min="0"
                        value="<?php echo htmlspecialchars($trem["peso"]); ?>"
                        required>
                </div>

                <div class="cadastro-trens-campo">
                    <label for="quantidade_vagoes">
                        Quantidade de vagões:
                    </label>

                    <input
                        type="number"
                        id="quantidade_vagoes"
                        name="quantidade_vagoes"
                        min="1"
                        value="<?php echo htmlspecialchars($trem["quantidade_vagoes"]); ?>"
                        required>
                </div>

                <div class="cadastro-trens-campo">
                    <label for="id_usuarios">
                        Proprietário
                    </label>

                    <select id="id_usuarios" name="id_usuarios" required>

                        <?php while ($usuario = mysqli_fetch_assoc($resultado_usuarios)): ?>
                            <option
                                value="<?= htmlspecialchars($usuario["id"]) ?>"
                                <?= $usuario["id"] == $trem["id_usuarios"] ? "selected" : "" ?>>
                                <?= htmlspecialchars($usuario["nome"]) ?>
                            </option>
                        <?php endwhile; ?>

                    </select>
                </div>

                <div class="cadastro-trens-botao">
                    <button type="submit">
                        Atualizar Trem
                    </button>
                </div>

            </form>


            <a href="gestao-trem.php" class="botao-voltar">
                Voltar
            </a>

        </div>

    </div>

</main>
</body>
</html>
