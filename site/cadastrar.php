<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="login-card">
            <div class="row no-gutters">
                <div class="col-md-5 area-img">
                    <img class="login-card-img" id="pacote" src="<?= SITE_URL ?>assets/img/pacote.jpg" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-7">
                    <div class="card card-body">
                        <form class="p-3">
                            <h3>Cadastro</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nome">Nome<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" maxlength="100" id="nome" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="telefone">Telefone<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="11" class="form-control" id="telefone" autofocus required>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="email">E-mail<span class="text-danger">*</span></label>
                                        <input type="email" maxlength="100" class="form-control" id="email" aria-describedby="emailHelp" autofocus required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="password">Senha<span class="text-danger">*</span></label>
                                        <input type="password" maxlength="15" class="form-control" id="password" id="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirme sua senha<span class="text-danger">*</span></label>
                                        <input type="password" maxlength="15" class="form-control" id="confirmPassword" id="confirmPassword" required>
                                    </div>
                                </div>
                                <div class="form-group mt-2 mb-3">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Mantenha-me conectado</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-group">
                                        <a class="btn btn-outline-secondary" href="<?= SITE_URL ?>" title="Voltar" id="voltar">Voltar</a>
                                        <button class="btn btn-primary" type="submit" id="entrar" title="Cadastrar">Cadastrar</button>
                                    </div>
                                </div>
                                <div class="linksLogin text-center mt-3 mb-4">
                                    <a href="<?= SITE_URL ?>login">Já possui conta? Faça seu login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>