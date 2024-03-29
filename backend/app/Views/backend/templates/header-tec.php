<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('sistema') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-cog fa-gears"></i>
            </div>
            <div class="sidebar-brand-text mx-3">TÉCNICO<sup>1.0.0</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link collapse py-sm-1" href="<?= base_url('painel') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Painel Geral</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapse py-sm-1" href="<?= base_url('teste') ?>">
                <i class="fas fa-cog fa-gears"></i>
                <span>Teste</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Site
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed py-sm-1" href="#" data-toggle="collapse" data-target="#collapseFaturamento" aria-expanded="true">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Faturamento</span>
            </a>
            <div id="collapseFaturamento" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header py-sm-1">Custom Components:</h6>
                    <a class="collapse-item py-sm-1" href="buttons.html">Visão Geral</a>
                    <a class="collapse-item py-sm-1" href="cards.html">Relatórios</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed py-sm-1" href="#" data-toggle="collapse" data-target="#collapseNotas" aria-expanded="true">
                <i class="fas fa-fw fa-scroll"></i>
                <span>Notas</span>
            </a>
            <div id="collapseNotas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item py-sm-1" href="<?= base_url('notas') ?>">Notas Emitidas</a>
                    <a class="collapse-item py-sm-1" href="utilities-color.html">Entrada de Nota</a>
                    <a class="collapse-item py-sm-1" href="utilities-border.html">Saída de Nota</a>
                    <a class="collapse-item py-sm-1" href="utilities-other.html">Consultar Nota</a>
                    <a class="collapse-item py-sm-1" href="utilities-animation.html">Carta de Correção</a>
                    <a class="collapse-item py-sm-1" href="utilities-animation.html">Cancelar Nota</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed py-sm-1" href="#" data-toggle="collapse" data-target="#collapseProducao" aria-expanded="true">
                <i class="fas fa-fw fa-box-open"></i>
                <span>Produção</span>
            </a>
            <div id="collapseProducao" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item py-sm-1" href="<?= base_url('producao/metas') ?>">Metas</a>
                    <a class="collapse-item py-sm-1" href="<?= base_url('producao/taloes') ?>">Entrada de Talão</a>
                    <a class="collapse-item py-sm-1" href="<?= base_url('producao/taloes/saida') ?>">Saída de Talão</a>
                    <a class="collapse-item py-sm-1" href="<?= base_url('producao/produtos') ?>">Produtos</a>
                    <a class="collapse-item py-sm-1" href="utilities-border.html">Montar Layout</a>
                    <a class="collapse-item py-sm-1" href="utilities-other.html">Relatórios</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Sistema
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed py-sm-1" href="#" data-toggle="collapse" data-target="#collapseUsuario" aria-expanded="true">
                <i class="fas fa-fw fa-users"></i>
                <span>Usuários</span>
            </a>
            <div id="collapseUsuario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item py-sm-1" href="<?= base_url('usuarios') ?>">Visualizar</a>
                    <a class="collapse-item py-sm-1" href="register.html">Permissões</a>
                    <a class="collapse-item py-sm-1" href="forgot-password.html">Cadastrar</a>
                    <a class="collapse-item py-sm-1" href="forgot-password.html">Remover</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed py-sm-1" href="#" data-toggle="collapse" data-target="#collapseEmpresa" aria-expanded="true">
                <i class="fas fa-fw fa-industry"></i>
                <span>Empresa</span>
            </a>
            <div id="collapseEmpresa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item py-sm-1" href="<?= base_url('empresa') ?>">Dados Cadastrais</a>
                    <a class="collapse-item py-sm-1" href="<?= base_url('empresa/clientes') ?>">Clientes</a>
                    <a class="collapse-item py-sm-1" href="register.html">Configurações</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed py-sm-1" href="#" data-toggle="collapse" data-target="#collapseFuncionario" aria-expanded="true">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>Funcionários</span>
            </a>
            <div id="collapseFuncionario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item py-sm-1" href="login.html">Visualizar</a>
                    <a class="collapse-item py-sm-1" href="register.html">Cadastrar</a>
                    <a class="collapse-item py-sm-1" href="forgot-password.html">Remover</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item active py-sm-1" href="blank.html">Relatórios</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link py-sm-1" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow" style="height: 4rem">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="font-weight-bolder text-lg ml-3 text-primary"><?= $title ?></span>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li  class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div style="width: 15rem" class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline w-100 navbar-search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary btn-sm" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-light border-0 small" placeholder="Procurando por..." aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </form>
                        </div>
                    </li>

                    <li class="nav-item dropdown no-arrow ml-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('usuario')['usuario'] ?></span>
                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" alt="">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Configurações
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logs
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-question fa-sm fa-fw mr-2 text-gray-400"></i>
                                Suporte
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sair do Sistema
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- End of Topbar -->

            <!--  Container  -->
            <div class="container-fluid px-0 mx-0 row">