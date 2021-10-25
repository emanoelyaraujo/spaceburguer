<h4>Alterar Senha</h4>
<form action="<?= SITE_URL ?>MinhaConta/updateSenha" method="post">
    <div class="d-flex align-items-center flex-column">
        <div class="col-md-5 mb-3">
            <label for="senhaAtual" class="form-label">Senha Atual</label>
            <input type="password" name="senhaAtual" id="senhaAtual" class="form-control" maxlength="15" minlength="8" required>
        </div>
        <div class="col-md-5 mb-3">
            <label for="novaSenha" class="form-label">Nova Senha</label>
            <input type="password" name="novaSenha" id="novaSenha" class="form-control" maxlength="15" minlength="8" required>
        </div>
        <div class="col-md-5 mb-3">
            <label for="confirmSenha" class="form-label">Confirme sua Senha</label>
            <input type="password" name="confirmSenha" id="confirmSenha" class="form-control" maxlength="15" minlength="8" required>
        </div>
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</form>