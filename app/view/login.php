<?= Formulario::exibeMsgError() . Formulario::exibeMsgSucesso() ?>
<div class="container vh-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table pt-4">
            <div class="card">
                <div class="card-body">
                    <div class="m-sm-4">
                        <div class="text-center">
                            <img src="<?= SITE_URL ?>assets/img/astronautaFoguete.jpg" 
                                class="img-fluid rounded-circle" width="132" height="132"
                            >
                        </div>
                        <div class="text-center mt-2">
                            <h3 style="color: #433A8F;" class="mb-0 fw-bold">Bem vindo(a)!</h3>
                            <p class="lead">Faça login em sua conta para continuar</p>
                        </div>
                        <form method="post" action="<?= SITE_URL ?>Login/login">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">E-mail<span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" 
                                    maxlength="100" placeholder="Digite seu e-mail" autofocus required
                                >
                            </div>
                            <div class="form-group mb-3">
                                <label for="senha" class="form-label">Senha<span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="senha" id="senha" minlength="8" 
                                    maxlength="15" placeholder="Coloque sua senha" required
                                >
                                <small>
                                    <a href="<?= SITE_URL ?>Login/esqueciMinhaSenha">Esqueceu sua senha?</a>
                                </small>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                                <button type="submit" class="btn btnRoxo">ENTRAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>