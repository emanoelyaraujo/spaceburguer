<div class="col-12">
    <?= Formulario::exibeMsgError() ?>
</div>

<h2>Redefinir senha</h2>
<form action="<?= SITE_URL ?>Login/updateSenha" method="post">
    <div class="d-flex align-items-center flex-column">
        <div class="col-md-5 mb-3">
            <label for="novaSenha" class="form-label">Nova Senha</label>
            <input type="password" name="novaSenha" id="novaSenha" class="form-control" maxlength="15" minlength="8" required>
        </div>
        <div class="col-md-5 mb-3">
            <label for="confirmSenha" class="form-label">Confirme sua Senha</label>
            <input type="password" name="confirmSenha" id="confirmSenha" class="form-control" maxlength="15" minlength="8" required>
        </div>
        <input type="hidden" name="id" value="<?= $dados["usuario"]["id"] ?>">
        <button type="submit" class="btn btnRoxo btnPerfil">REDEFINIR SENHA</button>
    </div>
</form>