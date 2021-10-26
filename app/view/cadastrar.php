<div class="justify-content-center vh-100">
    <main>
        <div class="container flex-column">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table">
                    <div class="text-center mt-2">
                        <h3 style="color: #433A8F;" class="mb-0 fw-bold">Cadastre-se!</h3>
                        <p class="lead">Conheça os melhores lanches da GALÁXIA.</p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center">
                                    <img src="<?= SITE_URL ?>assets/img/astronautaHamburguer.jpg" class="img-fluid rounded-circle" width="132" height="132">
                                </div>
                                <form method="post" action="<?= SITE_URL ?>Login/login">
                                    <div class="row form-group mb-3">
                                        <div class="col-6">
                                            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="nome" id="nome" maxlength="60" placeholder="Digite seu nome" autofocus required>
                                        </div>
                                        <div class="col-6">
                                            <label for="telefone" class="form-label">Telefone<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="telefone" id="telefone" maxlength="14" placeholder="(00)00000-0000" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" id="email" maxlength="14" placeholder="Digite seu e-mail" required>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-6">
                                            <label for="senha" class="form-label">Senha<span class="text-danger">*</span></label>
                                            <input class="form-control" type="password" name="senha" id="senha" maxlength="14" placeholder="Digite sua senha" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="confirmPassword" class="form-label">Confirmação<span class="text-danger">*</span></label>
                                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" minlength="8" maxlength="15" placeholder="Confirme sua senha" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <?= Formulario::exibeMsgError() ?>
                                    </div>

                                    <div class="col-12">
                                        <?= Formulario::exibeMsgSucesso() ?>
                                    </div>
                                    <div class="d-grid gap-2 col-6 mx-auto mt-4">
                                        <button type="submit" class="btn btnRoxo">ENTRAR</button>
                                        <small class="text-center">
                                            <a href="<?= SITE_URL ?>Login/index">Já possui conta? Faça seu login</a>
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

<script>
    $(document).ready(function() {
        $("#telefone").mask('(00)00000-0000');
    });
</script>