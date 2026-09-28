<?php

include "../infra/conn.php";

// busca rota
$id = $_GET["id"];
$sql = "SELECT * FROM rotas WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$rota = mysqli_fetch_assoc($resultado);


// busca usuário proprietário
$sql_usuarios = "SELECT id, nome FROM usuarios";
$resultado_usuarios = mysqli_query($conn, $sql_usuarios);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rota</title>
    <link rel="stylesheet" href="../styles/style.css">

</head>
<body>
    
    <main id="cadastro-rotas">
        <h2>Editar Rota</h2>
    
        <div class="cadastro-rotas-container">
    
            <div class="cadastro-rotas-card editar-rota-card">
    
                <form action="atualizar-rota.php" method="POST">
    
                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $rota["id"]; ?>">
    
                    <div class="cadastro-rotas-campo">
    
                        <label for="nome">
                            Nome da rota
                        </label>
    
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            value="<?php echo htmlspecialchars($rota["nome"]); ?>"
                            required>
    
                    </div>
    
                    <div class="cadastro-rotas-campo">
    
                        <label for="saida">
                            Saída
                        </label>
    
                        <input
                            type="text"
                            id="saida"
                            name="saida"
                            value="<?php echo htmlspecialchars($rota["saida"]); ?>"
                            required>
    
                    </div>
    
                    <div class="cadastro-rotas-campo">
    
                        <label for="destino">
                            Destino
                        </label>
    
                        <input
                            type="text"
                            id="destino"
                            name="destino"
                            value="<?php echo htmlspecialchars($rota["destino"]); ?>"
                            required>
    
                    </div>

                    <div class="cadastro-rotas-botao">
                        <button type="submit">
                            Atualizar Rota
                        </button>
                    </div>
                </form>
    
                <a href="gestao-rota.php" class="botao-voltar">
                    Voltar
                </a>

            </div>
        </div>
    </main>
</body>
</html>
