<section>
    <h2>Seu perfil</h2>
    <form action="<?= SITE_URL ?>MinhaConta/updateDados" method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-end">
            <a href="<?= SITE_URL ?>MinhaConta/solicitarTrocaEmail" class="btn btn-outline-secondary btn-sm">
                Alterar e-mail
            </a>
        </div>
        <div class="d-flex align-items-center flex-column">
            <div class="d-flex justify-content-center">
                <img src="<?= is_null($_SESSION['userImagem']) ? 
                    SITE_URL . "assets/img/user2.jpg" : 
                    SITE_URL . "uploads/usuarios/" . $_SESSION['userImagem'] ?>" 
                    class="rounded-circle rounded-full" width="180" height="180" alt=""
                >
            </div>
            <div class="col-sm-8 col-md-5 col-lg-5">
                <div class="form-group mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" maxlength="60" 
                        value="<?= isset($_SESSION["userNome"]) ? $_SESSION["userNome"] : "" ?>"
                    >
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" readonly name="email" id="email" class="form-control" 
                        maxlength="100" value="<?= isset($_SESSION["userEmail"]) ? $_SESSION["userEmail"] : "" ?>"
                    >
                </div>
                <div class="form-group mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" maxlength="14" 
                        value="<?= isset($_SESSION["userTelefone"]) ? $_SESSION["userTelefone"] : "" ?>"
                    >
                </div>
                <div class="form-group mt-3 mb-3">
                    <input type="file" class="form-control" name="imagem" id="imagem" accept="image/png, image/jpeg, image/jpg">
                </div>
            </div>
            <input type="hidden" name="nomeImagem" value="<?= !is_null($_SESSION['userImagem']) ? $_SESSION['userImagem'] : "" ?>">
            <button type="submit" class="btn btnRoxo btnPerfil mt-2 mb-4">SALVAR INFORMAÇÕES</button>
        </div>
    </form>
</section>