<div class="col-12">
    <?= Formulario::exibeMsgError() ?>
</div>

<div class="container">
    <h2>Redefinir senha</h2>
    <form action="<?= SITE_URL ?>Login/updateSenha" method="post">
        <div class="d-flex align-items-center flex-column">
            <div class="col-md-5 mb-3">
                <label for="novaSenha" class="form-label">Nova Senha</label>
                <input type="password" name="novaSenha" id="novaSenha" class="form-control" 
                    maxlength="15" minlength="8" required
                >
            </div>
            <div class="col-md-5 mb-3">
                <label for="confirmSenha" class="form-label">Confirme sua Senha</label>
                <input type="password" name="confirmSenha" id="confirmSenha" class="form-control" 
                    maxlength="15" minlength="8" required
                >
            </div>
            <input type="hidden" name="id" value="<?= $dados["usuario"]["id"] ?>">
            <button type="submit" class="btn btnRoxo btnPerfil">REDEFINIR SENHA</button>
        </div>
    </form>
</div>
<script>
    var password = document.getElementById("novaSenha"),
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