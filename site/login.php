<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="login-card">
            <div class="row no-gutters">
                <div class="col-md-5 area-img">
                    <img class="login-card-img" id="pacote" src="<?= SITE_URL ?>assets/img/pacote.jpg" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-7">
                    <div class="card card-body">
                        <form method="post" action="" class="row justify-content-center align-items-center">
                            <div class="col-lg-6">
                                <h3>Login</h3>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="senha" class="form-label">Senha<span class="text-danger">*</span></label>
                                    <input type="senha" name="senha" class="form-control" id="senha" required>
                                </div>
                                <div class="form-group mt-2 mb-3">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Mantenha-me conectado</label>
                                </div>
                                <div class="col-6 mx-auto">
                                    <a href="<?= SITE_URL ?>home" type="submit" class="btn btn-outline-secondary">Voltar</a>
                                    <button type="submit" class="btn btn-primary">Entrar</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="">Esqueci minha senha</a><br>
                            <a href="<?= SITE_URL ?>cadastrar">Novo no site? Cadastre-se</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>