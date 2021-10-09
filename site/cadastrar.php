<div class="container">

    <div class="row">
        <div class=" col-md-6 offset-md-3 shadow-lg p-1 login">
            <form class="row align-self-center" action="#" method="post">

                <div class="form-group col-md-6">
                    <svg class="bi" ... role="img" aria-label="Tools">
                        <use xlink:href="bootstrap-icons.svg#tools" />
                    </svg>
                </div>

                <div class="form-group col-md-12 mt-3">
                    <label for="input-group">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Ex: João de Souza" required>
                </div>

                <div class="form-group col-md-12 mt-3">
                    <label for="input-group">Email</label>
                    <input type="email" class="form-control" name="emai" id="email" placeholder="exemplo@exemplo.com" required>
                </div>

                <div class="form-group col-md-6 mt-3">
                    <label for="input-group">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="********" required>
                </div>

                <div class="form-group col-md-6 mt-3">
                    <label for="input-group">Confirme seu password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="********" required>
                </div>

                <div class="form-group col-md-12 mt-3">
                    <label for="input-group">Foto perfil</label>
                    <input type="text" class="form-control" name="linkFoto" id="linkFoto" placeholder="Insera o link da imagem para carrega-la">
                </div>

                <div class="col-md-12 novaConta text-center mt-4">
                    <a type="submit" class="btn btn-primary" href="<?=SITE_URL?>login">Cadastar</a>
                </div>
            </form>
        </div>
    </div>

</div>