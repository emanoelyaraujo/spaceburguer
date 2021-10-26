<section>
    <h2>Seu perfil</h2>
    <form action="<?= SITE_URL ?>MinhaConta/updateDados" method="post">
        <div class="d-flex align-items-center flex-column">
            <div class="d-flex justify-content-center">
                <img src="<?= SITE_URL ?>assets/img/user2.jpg" class="rounded-circle rounded-full" width="180" height="180" alt="">
            </div>
            <div class="col-md-5 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" maxlength="60" value="<?= isset($_SESSION["userNome"]) ? $_SESSION["userNome"] : "" ?>">
            </div>
            <div class="col-md-5 mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" maxlength="100" value="<?= isset($_SESSION["userEmail"]) ? $_SESSION["userEmail"] : "" ?>">
            </div>
            <div class="col-md-5 mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" maxlength="14" value="<?= isset($_SESSION["userTelefone"]) ? $_SESSION["userTelefone"] : "" ?>">
            </div>

            <button type="submit" class="btn btnRoxo btnPerfil mt-2">SALVAR INFORMAÇÕES</button>
        </div>
    </form>
</section>