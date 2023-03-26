<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>

<div class="position-fixed d-grid p-3 me-5 text-white bg-dark end-0" style="height: 100%; width: 40%;">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"></svg>
        <span class="fs-4">Login</span>
    </div>
    <hr>
    <label for="basic-url" class="form-label">Usuário</label>
    <div class=" mb-3">
        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>

    <label for="basic-url" class="form-label">Senha</label>
    <div class="mb-3">
        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>

    <button class="btn btn-primary" type="button">Button</button>

</div>
<div class="position-absolute translate-middle top-50" style="left: 28%">
    <img src="img/logo.jpeg" class="" alt="logo da empresa">
</div>
<?php include __DIR__ . '/../Componentes/fim-html.php'; ?>
