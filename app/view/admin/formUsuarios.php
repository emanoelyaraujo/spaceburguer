<?= Formulario::titulo("Usuário", [
    "controller" => "usuarioAdmin",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<main class="container">
    <section class="mb-5">
        <form method="POST" action="<?= SITE_URL ?>usuarioAdmin/<?= $aDados['acao'] ?>">
            <div class="row">
                <div class="form-group col-12 col-md-8 col-sm-5 mb-3">
                    <label for="nome" class="form-label">Nome <span class='fw-bold text-danger'>*</span></label>
                    <input type="text" name="nome" id="nome" class="form-control" maxlength="50" 
                        <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> 
                        value="<?= isset($aDados['data']['nome']) ? $aDados['data']['nome'] : "" ?>" 
                        required autofocus placeholder="Nome completo do usuário"
                    >
                </div>

                <div class="form-group col-md-3 col-6 mb-3">
                    <label for="status" class="form-label">Status <span class='fw-bold text-danger'>*</span></label>
                    <select name="status" id="status" class="form-control" required <?= Helpers::$acoesInput[$aDados['acao']]['disabled'] ?>>
                        <option value="" selected disabled></option>
                        <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?>>
                            Ativo
                        </option>
                        <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?>>
                            Inativo
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-3 col-6 mb-3">
                    <label for="nivel" class="form-label">Nível <span class='fw-bold text-danger'>*</span></label>
                    <select name="nivel" id="nivel" class="form-control" required <?= Helpers::$acoesInput[$aDados['acao']]['disabled'] ?>>
                        <option value="" selected disabled></option>
                        <option value="1" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == "1"   ? "selected" : "") : "") ?>>
                            Administrador
                        </option>
                        <option value="2" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == "2"  ? "selected" : "") : "") ?>>
                            Usuário
                        </option>
                        <option value="3" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == "3"  ? "selected" : "") : "") ?>>
                            Motoboy
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-5 col-12 mb-3">
                    <label for="email" class="form-label">E-mail <span class='fw-bold text-danger'>*</span></label>
                    <input type="text" name="email" id="email" class="form-control" maxlength="100" 
                        <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> 
                        value="<?= isset($aDados['data']['email']) ? $aDados['data']['email'] : "" ?>" 
                        required placeholder="seuemail@dominio.com"
                    >
                </div>

                <div class="form-group col-12 col-md-3 mb-3">
                    <label for="telefone" class="form-label">Telefone <span class='fw-bold text-danger'>*</span></label>
                    <input type="text" name="telefone" id="telefone" class="form-control" minlength="11" maxlength="15" 
                        <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> 
                        value="<?= isset($aDados['data']['telefone']) ? $aDados['data']['telefone'] : "" ?>"
                    >
                </div>

                <div class="form-group col-12 col-md-3 mb-3">
                    <label for="senha" class="form-label">Senha <span class='fw-bold text-danger'>*</span></label>
                    <input type="password" name="senha" id="senha" class="form-control" minlength="8" maxlength="15" 
                        <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> autocomplete="on"
                        value="<?= isset($aDados['data']['senha']) ? $aDados['data']['senha'] : "" ?>"
                    >
                </div>

                <div class="form-group col-12 col-md-3 mb-3">
                    <label for="confirmacao" class="form-label">Confirmação <span class='fw-bold text-danger'>*</span></label>
                    <input type="password" name="confirmacao" id="confirmacao" class="form-control" minlength="8" maxlength="15" 
                        <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> autocomplete="on"
                        value="<?= isset($aDados['data']['senha']) ? $aDados['data']['senha'] : "" ?>"
                    >
                </div>

                <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">

            </div>
            <div class="form-group col-12 col-md-4 mt-2">
                <a href="<?= SITE_URL ?>/usuarioAdmin/lista" class="btn btn-outline-secondary">Voltar</a>
                <?php if ($acao != "view") : ?>
                    <button type="submit" class="btn btn-<?= Helpers::$botoes[$aDados['acao']]['corBotao'] ?> me-3">
                        <?= Helpers::$botoes[$aDados['acao']]['textoBotao'] ?>
                    </button>
                <?php endif; ?>
            </div>
        </form>
    </section>
</main>

<script>
    var password = document.getElementById("senha"),
        confirm_password = document.getElementById("confirmacao");

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