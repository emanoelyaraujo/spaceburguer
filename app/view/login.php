<div class="justify-content-center vh-100">
    <main>
        <div class="container flex-column">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table pt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center">
                                    <img src="<?= SITE_URL ?>assets/img/astronautaFoguete.jpg" class="img-fluid rounded-circle" width="132" height="132">
                                </div>
                                <div class="text-center mt-2">
                                    <h3 style="color: #433A8F;" class="mb-0 fw-bold">Bem vindo(a)!</h3>
                                    <p class="lead">Faça login em sua conta para continuar</p>
                                </div>
                                <form method="post" action="<?= SITE_URL ?>Login/login">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" id="email" maxlength="100" placeholder="Digite seu e-mail" autofocus required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="senha" class="form-label">Senha</label>
                                        <input class="form-control" type="password" name="senha" id="senha" minlength="8" maxlength="15" placeholder="Coloque sua senha" required>
                                        <small>
                                            <a href="<?= SITE_URL ?>Login/esqueciMinhaSenha">Esqueceu sua senha?</a>
                                        </small>
                                    </div>
                                    <div class="col-12">
                                        <?= Formulario::exibeMsgError() ?>
                                    </div>

                                    <div class="col-12">
                                        <?= Formulario::exibeMsgSucesso() ?>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked="">
                                            <label class="form-check-label text-small" for="customControlInline">Lembre-se de mim na próxima vez</label>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 col-6 mx-auto mt-4">
                                        <button type="submit" class="btn btnRoxo">ENTRAR</button>
                                        <small class="text-center">
                                            <a href="<?= SITE_URL ?>Login/cadastrar">Novo no site? Cadastre-se</a>
                                        </small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>