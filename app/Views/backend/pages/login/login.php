<form action="<?= base_url('login/entrar') ?>" method="post"
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
    <div class="mb-5 d-grid">
        <button class="btn btn-primary btn-lg text-light mb-5">Login</button>
    </div>
</form>
<div class="position-absolute translate-middle top-50" style="left: 28%">
    <img src="/img/MeuLogo1.svg" style="width: 30rem" alt="logo da empresa">
</div>