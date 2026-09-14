<?php
include "../infra/conn.php";

?>

<html lang="en">
<?php
$paginaAtual = "cadastro";
$submenuAtual = "rotas";
include("navbar.php");
?>

    <main>

        <!--Início do campo de cadastro de rotas-->

        <div>
            <div class="container-menor" style="margin-top: 150px; justify-self: center;">
                <p style="font-size: 18px;">Nome:</p>
                <div class="input-group mb-3">
                    <input type="text" id="nome" class="form-control" placeholder="Insira o Nº da rota"
                        style="margin-top: 15px; max-width: 300px; border-radius: 0%; border: 1px solid #353535">
                    </input>
                </div>

                <p style="font-size: 18px;">Saída:</p>
                <div class="input-group mb-3">
                    <input type="text" id="saida" class="form-control" placeholder="Insira a saída"
                        style="margin-top: 15px; max-width: 300px; border-radius: 0%; border: 1px solid #353535">
                    </input>
                </div>

                <p style="font-size: 18px;">Destino:</p>
                <div class="input-group mb-3">
                    <input type="text" id="destino" class="form-control" placeholder="Insira o destino"
                        style="margin-top: 15px; max-width: 300px; border-radius: 0%; border: 1px solid #353535">
                    </input>
                </div>

                <button type="button" class="btn btn-primary"
                    style="border-radius: 20px; font-size: 20px;">Cadastrar</button>
            </div>
        </div>

        <!--Fim do campo de cadastro de rotas-->

        <div class="trens" style="margin-top: 80px; justify-self: center; width: 70%;">
            <span style="font-size: 25px; font-weight: 700;">Rotas cadastradas:</span>
            <div class="container-maior">
                <div class="d-flex mt-3 mb-3 gap-5" style="align-items: center;">
                    <h5 class="ms-5 mb-0" style="font-weight: 700">Busque:</h5>
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-size: 20px;">Status</span>
                        <select class="form-select"
                            style="max-width: 120px; border-radius: 0%; border: 1px solid #353535; align-self: center;">
                            <option selected>Selecione</option>
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span style="font-size: 20px;">ID</span>
                        <input type="text" class="form-control" placeholder="Insira o ID do Trem"
                            style="width: 300px; border-radius: 0%; border: 1px solid #353535">
                        </input>
                    </div>
                </div>
                <div class="d-flex mt-5 mb-3 gap-5" style="align-items: center;">
                    <div class="ms-5 gap-2">
                        <p style="font-size: 20px; margin-bottom: 8px;">ROTA_01</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ROTA_02</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ROTA_03</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ROTA_04</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ROTA_05</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ROTA_06</p>
                    </div>
                    <div class="ms-2 gap-2">
                        <p style="font-size: 20px; margin-bottom: 8px;">ID Rota: ro01</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ID Rota: ro02</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ID Rota: ro03</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ID Rota: ro04</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ID Rota: ro05</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ID Rota: ro06</p>
                    </div>
                    <div class="ms-2 gap-2">
                        <p style="font-size: 20px; margin-bottom: 8px;">Saída: São Paulo</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Saída: São Paulo</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Saída: São Paulo</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Saída: São Paulo</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Saída: São Paulo</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Saída: São Paulo</p>
                    </div>
                    <div class="ms-2 gap-2">
                        <p style="font-size: 20px; margin-bottom: 8px;">Destino: Rio de Janeiro</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Destino: Rio de Janeiro</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Destino: Rio de Janeiro</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Destino: Rio de Janeiro</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Destino: Rio de Janeiro</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">Destino: Rio de Janeiro</p>
                    </div>
                    <div class="ms-2 gap-2" style="text-align: center">
                        <p style="font-size: 20px; margin-bottom: 8px;">ATIVO</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ATIVO</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ATIVO</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ATIVO</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">INATIVO</p>
                        <p style="font-size: 20px; margin-bottom: 8px;">ATIVO</p>
                    </div>
                    <div class="ms-auto me-5">
                        <div class="d-flex gap-1 mb-2">
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Desativar Rota</button>
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Atualizar</button>
                        </div>
                        <div class="d-flex gap-1 mb-2">
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Desativar Rota</button>
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Atualizar</button>
                        </div>
                        <div class="d-flex gap-1 mb-2">
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Desativar Rota</button>
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Atualizar</button>
                        </div>
                        <div class="d-flex gap-1 mb-2">
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Desativar Rota</button>
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Atualizar</button>
                        </div>
                        <div class="d-flex gap-1 mb-2">
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Ativar Rota</button>
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Atualizar</button>
                        </div>
                        <div class="d-flex gap-1 mb-2">
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Desativar Rota</button>
                            <button
                                style="width: 150px; padding: 5px; border-radius: 0%; border: 1px solid #353535; background-color:white ; font-size: 15px;">
                                Atualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>
    <!-- POPUP DE SAIR (overlay) -->
        <div class="popup" id="popup">
            <div class="overlay"></div>
            <div class="popup-content">
                <h2>Aviso</h2>
                <p>Você deseja sair da sua conta?</p>
                <h6>(Seu progresso será salvo automaticamente)</h6>
                <div class="controls">
                    <button class="fechar-popup nav-link mx-lg-2"
                        onclick="window.location.href='login.php'">Sim</button>
                    <button class="close-btn nav-link mx-lg-2">Não</button>
                </div>
            </div>
        </div>
    <!-- Scripts -->
    <script src="../scripts/botao-sair.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="../scripts/cadastro-rota.js"></script>
</body>
    
</html>