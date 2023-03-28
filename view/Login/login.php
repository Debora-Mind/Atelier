<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>

<form action="/realiza-login" method="post"
      class="position-fixed d-grid p-4 me-5 text-white bg-dark end-0"
      style="height: 100%; width: 40%;">
    <span class="fs-1 text-center text-white mt-4">Login</span>
    <hr>
    <div class="form-group mb-5">
        <label for="usuario" class="form-label">Usuário</label>
        <input type="text" class="form-control mb-5" id="usuario" name="usuario" aria-describedby="basic-addon3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control mb-3" id="senha" name="senha" aria-describedby="basic-addon3">
    </div>
    <div style="height: 5rem">
        <?php include __DIR__ . '/../Componentes/mensagens.php';?>
    </div>
    <div class="mb-5 d-grid">
        <button class="btn btn-primary btn-lg mb-5">Login</button>
    </div>
</form>
<div class="position-absolute translate-middle top-50" style="left: 28%">
    <img src="img/logo.png" class="" alt="logo da empresa">
</div>
<?php include __DIR__ . '/../Componentes/fim-html.php'; ?>
