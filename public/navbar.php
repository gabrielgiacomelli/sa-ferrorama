<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css?v=1.1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
    <header >
            <div>
        
                <div id="navbar-ferroviario-contraste">
                    <div id="navbar-ferroviario">
                        <nav >
                            <ul id="navbar-flex">
                                <li>
                                    <a href="home.php"
                                    class="<?= $paginaAtual == 'home' ? 'ativo' : '' ?>">
                                    Home
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a class="<?= $paginaAtual == 'cadastro' ? 'ativo' : '' ?>">
                                        Cadastro
                                    </a>

                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="cadastro-sensor.php"
                                            class="<?= $submenuAtual == 'sensores' ? 'submenu-ativo' : '' ?>">
                                            Sensores
                                            </a>
                                        </li>

                                        <li>
                                            <a href="cadastro-trem.php"
                                            class="<?= $submenuAtual == 'trens' ? 'submenu-ativo' : '' ?>">
                                            Trens
                                            </a>
                                        </li>

                                        <li>
                                            <a href="cadastro-rota.php"
                                            class="<?= $submenuAtual == 'rotas' ? 'submenu-ativo' : '' ?>">
                                            Rotas
                                            </a>
                                        </li>

                                        <li>
                                            <a href="cadastro-relatorio.php"
                                            class="<?= $submenuAtual == 'relatorios' ? 'submenu-ativo' : '' ?>">
                                            Relatórios
                                            </a>
                                        </li>

                                        <li>
                                            <a href="cadastro-usuario.php"
                                            class="<?= $submenuAtual == 'usuarios' ? 'submenu-ativo' : '' ?>">
                                            Usuários
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a class="<?= $paginaAtual == 'gestao' ? 'ativo' : '' ?>">
                                        Gestão
                                    </a>

                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="sensores.php"
                                            class="<?= $submenuAtual == 'gestao-sensores' ? 'submenu-ativo' : '' ?>">
                                            Sensores
                                            </a>
                                        </li>

                                        <li>
                                            <a href="trem.php"
                                            class="<?= $submenuAtual == 'gestao-trens' ? 'submenu-ativo' : '' ?>">
                                            Trens
                                            </a>
                                        </li>

                                        <li>
                                            <a href="rota.php"
                                            class="<?= $submenuAtual == 'gestao-rotas' ? 'submenu-ativo' : '' ?>">
                                            Rotas
                                            </a>
                                        </li>

                                        <li>
                                            <a href="relatorios.php"
                                            class="<?= $submenuAtual == 'gestao-relatorios' ? 'submenu-ativo' : '' ?>">
                                            Relatórios
                                            </a>
                                        </li>

                                        <li>
                                            <a href="usuarios.php"
                                            class="<?= $submenuAtual == 'gestao-usuarios' ? 'submenu-ativo' : '' ?>">
                                            Usuários
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                                <li>
                                    <a href=""
                                    class="<?= $paginaAtual == 'monitoramento' ? 'ativo' : '' ?>">
                                    Monitoramento
                                    </a>
                                </li>
                            </ul>

                        </nav>
                    </div>
                </div>

            </div>
    </header>