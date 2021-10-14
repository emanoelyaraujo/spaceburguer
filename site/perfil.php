<script>
    $(document).ready(function() {
        $("#telefone").mask('(00)00000-0000');
    });
</script>

<div class="d-flex flex-column flex-md-row">
    <div class="nav d-flex flex-md-column nav-pills me-3 mt-3 ms-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" title="Meu Perfil">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </button>
        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" title="Meus Endereço">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
        </button>
        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" title="Meus Cartões">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                <line x1="1" y1="10" x2="23" y2="10"></line>
            </svg>
        </button>
        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" title="Alterar senha">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
            </svg>
        </button>
    </div>

    <div class="container mt-4">
        <div class="col-12">
            <?= Formulario::exibeMsgError() ?>
        </div>
        <div class="col-12">
            <?= Formulario::exibeMsgSucesso() ?>
        </div>

        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">
                <h4>Meu Perfil</h4>
                <form action="<?= SITE_URL ?>usuario/update" method="post">
                    <div class="d-flex align-items-center flex-column">
                        <div class="d-flex justify-content-center">
                            <img src="<?= SITE_URL ?>assets/img/user.png" class="rounded-full w-75" alt="">
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
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <h4>Alterar Senha</h4>
                <form action="<?= SITE_URL ?>usuario/update" method="post">
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
                            <label for="confirmSenha" class="form-label">Confirmae sua Senha</label>
                            <input type="password" name="confirmSenha" id="confirmSenha" class="form-control" maxlength="15" minlength="8" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>