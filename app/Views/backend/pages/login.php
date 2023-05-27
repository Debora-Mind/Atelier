<?php //var_dump(\Config\Services::validation()->listErrors()); exit(); ?>

<body class="bg-gradient-primary">
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5 w-50">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Vamos trabalhar?</h1>
                            </div>
                            <form action="<?= base_url('login/entrar') ?>" method="post">

                                <div class="form-group">
                                    <label for="usuario">Usuário</label>
                                    <input class="form-control" id="usuario" name="usuario"/>
                                </div>

                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input class="form-control" type="password" id="senha" name="senha"/>
                                </div>
                                <?= csrf_field(); ?>
                                <input type="submit" name="submit" class="btn btn-primary" value="Entrar" />
                                <h1 class="text-danger">
                                    <?= \Config\Services::validation()->getError('usuario') ?>
                                    <?= \Config\Services::validation()->getError('senha') ?>
                                </h1>
                            </form>

                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="fixed-bottom bg-white py-1">
        <div class="container my-auto">
            <div class="text-center">
                <span>Do-And-Make Desenvolvimento de Sistemas &copy; 2023</span>
            </div>
        </div>
    </footer>
</body>