<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="login-card">
            <div class="row no-gutters">
                <div class="col-md-5 px-0 area-img">
                    <img class="login-card-img" id="pacote" src="<?= SITE_URL ?>assets/img/pacote.jpg" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-7">
                    <div class="card card-body">
                        <div class="area-logo">
                            <img class="logo-login" src="<?= SITE_URL ?>assets/img/simbolo.png" alt="">
                        </div>
                        <form method="post" action="<?= SITE_URL ?>Login/login" class="row justify-content-center align-items-center">
                            <h4 class="text-center pb-2">ENTRE COM SEU LOGIN</h4>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="senha" class="form-label">Senha<span class="text-danger">*</span></label>
                                    <input type="password" name="senha" class="form-control" id="senha" required>
                                </div>
                                <div class="form-group mt-2 mb-3">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Mantenha-me conectado</label>
                                </div>
                                <div class="col-12">
                                    <?= Formulario::exibeMsgError() ?>
                                </div>

                                <div class="col-12">
                                    <?= Formulario::exibeMsgSucesso() ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="<?= SITE_URL ?>Home/index" type="submit" class="btn btn-outline-secondary me-1">Voltar</a>
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="">Esqueci minha senha</a><br>
                            <a href="<?= SITE_URL ?>Login/cadastrar">Novo no site? Cadastre-se</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>