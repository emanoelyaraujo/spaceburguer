<div class="container">

    <div class="row">
        <div class=" col-md-6 offset-md-3 shadow-lg login">
            <form class="row align-self-center" action="#" method="post">

                <div class="form-group col-md-6">
                    <svg class="bi" ... role="img" aria-label="Tools">
                        <use xlink:href="bootstrap-icons.svg#tools" />
                    </svg>
                </div>

                <div class="form-group col-md-12">
                    <label for="input-group">Usuário</label>
                    <input type="email" class="form-control" name="usuario" id="email" placeholder="exemplo@teste.com" required>
                </div>

                <div class="form-group col-md-12 mt-3">
                <label for="input-group">Senha</label>
                    <input type="password" class="form-control" name="password" id="senha" placeholder="********" required>
                </div>

                <div class="col-md-12 offset-md-5">
                    <a type="submit" href="#" class="btn btn-primary mt-3">Login</a>
                </div>
                <div class="col-md-12 novaConta text-center mt-4">
                    <a type="submit" href="<?=SITE_URL?>cadastrar">Criar minha conta</a>
                </div>

            </form>
        </div>
    </div>

</div>