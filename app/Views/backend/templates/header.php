<!-- Conteúdo da Página -->
<div id="wrapper">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">

            <!-- Navbar - Brand -->
            <a class="navbar-brand" href="/">
                <img src="/img/MeuLogo2.svg" alt="Logo Do-And-Make" style="height: 1.7rem">
            </a>
            <button value="" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Item - Geral -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto flex-grow-1">

                    <!-- Nav Item - Cadastros -->
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <!-- Nav Item - Dropdown -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/empresa">Empresa</a></li>
                            <li><a class="dropdown-item" href="/usuarios">Usuários</a></li>
                            <li><a class="dropdown-item" href="/funcoes">Funções</a></li>
                            <li><a class="dropdown-item disabled" href="#">Funcionários</a></li>
                            <li><a class="dropdown-item" href="/modelos">Modelos</a></li>
                            <li><a class="dropdown-item" href="/taloes">Talões</a></li>
                        </ul>
                    </li>

                    <!-- Nav Item - Produção -->
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Produção
                        </a>
                        <!-- Nav Item - Dropdown -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/formulario-saida">Dar Saída</a></li>
                            <li><a class="dropdown-item disabled" href="#">Montar Layout</a></li>
                        </ul>
                    </li>

                    <!-- Nav Item - Quadro de Produção -->
                    <li class="nav-item disabled">
                        <a class="nav-link active" href="#">Quadro de Produção</a>
                    </li>

                    <!-- Nav Item - Visão Geral -->
                    <li class="nav-item disabled">
                        <a class="nav-link active" href="#">Visão Geral</a>
                    </li>
                </ul>

                <!-- Nav Item - Float-End -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/configuracoes">
                            <i class="bi bi-gear"></i>
                            Configuração
                        </a>
                    </li>                <li class="nav-item">
                        <a class="nav-link active" href="/login">
                            <i class="bi bi-box-arrow-right"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fim do Navbar -->

<!-- MELHORAR -->
<!-- Background - Logo -->
<div style="height: 1rem"></div>
<div id="conteudo" class="container-xl mt-5 bg-transparent w-100" style="max-width: 90%">

    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
    <?=
    "<div id='logo' 
            class='fixed-bottom h-100' 
            style='background-image: url(/visualizar-logo?id={$_SESSION["empresa"]})'>
        </div>"
    ?>
<?php endif; ?>