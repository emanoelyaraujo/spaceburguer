<?= Formulario::exibeMsgError() . Formulario::exibeMsgSucesso() ?>
<div class="container vh-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table pt-4">
            <div class="card">
                <div class="card-body">
                    <div class="m-sm-4">
                        <div class="text-center">
                            <img src="<?= SITE_URL ?>assets/img/astronautaHamburguer.jpg" class="img-fluid rounded-circle" width="132" height="132">
                        </div>
                        <div class="text-center mt-2">
                            <h3 style="color: #433A8F;" class="mb-0 fw-bold">Cadastre-se!</h3>
                            <p class="lead">Conheça os melhores lanches da GALÁXIA.</p>
                        </div>
                        <form method="post" action="<?= SITE_URL ?>Login/register">
                            <div class="row form-group mb-3">
                                <div class="col-6">
                                    <label for="nome" class="form-label">Nome<span class="spanRed">*</span></label>
                                    <input class="form-control" type="text" name="nome" id="nome" maxlength="60" placeholder="Digite seu nome" autofocus required>
                                </div>
                                <div class="col-6">
                                    <label for="telefone" class="form-label">Telefone<span class="spanRed">*</span></label>
                                    <input class="form-control" type="text" name="telefone" id="telefone" maxlength="14" placeholder="(00)00000-0000" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">E-mail<span class="spanRed">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" value="<?= $dados["email"] ?>" maxlength="100" placeholder="Digite seu e-mail" readonly>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-6">
                                    <label for="senha" class="form-label">Senha<span class="spanRed">*</span></label>
                                    <input class="form-control" type="password" name="senha" id="senha" maxlength="15" placeholder="Digite sua senha" required>
                                </div>
                                <div class="col-6">
                                    <label for="confirmSenha" class="form-label">Confirmação<span class="spanRed">*</span></label>
                                    <input class="form-control" type="password" name="confirmSenha" id="confirmSenha" minlength="8" maxlength="15" placeholder="Confirme sua senha" required>
                                </div>
                                <small class="text-danger" id="error"></small>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                                <button type="submit" id="entrar" class="btn btnRoxo">ENTRAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var password = document.getElementById("senha"),
        confirm_password = document.getElementById("confirmSenha");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Senhas diferentes!");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>