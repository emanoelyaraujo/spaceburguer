<main>
    <script>
        $(document).ready(function() {
            $("#telefone").mask('(00)00000-0000');
            $("#cep").mask('00000-000');
        });

        function changeSession() {
            let id = $("button.active").data("bs-target")

            $.post("/MinhaConta/setPill", {
                id
            });
        }
    </script>

    <?php
    if (!isset($_SESSION['pill']))
    {
        $_SESSION["pill"] = "#v-pills-dados";
    }
    ?>

    <div class="d-flex flex-column flex-md-row vh-100">
        <div class="nav d-flex flex-md-column nav-pills me-3 mt-3 ms-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link <?= Redirect::getPills('#v-pills-dados') ?>" onclick="changeSession('#v-pills-dados')" id="v-pills-dados-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dados" type="button" role="tab" title="Meu Perfil">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </button>
            <button class="nav-link <?= Redirect::getPills('#v-pills-endereco') ?>" onclick="changeSession('#v-pills-endereco')" id="v-pills-endereco-tab" data-bs-toggle="pill" data-bs-target="#v-pills-endereco" type="button" role="tab" title="Meus Endereço">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </button>
            <button class="nav-link <?= Redirect::getPills('#v-pills-cartao') ?>" onclick="changeSession('#v-pills-cartao')" id="v-pills-cartao-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cartao" type="button" role="tab" title="Meus Cartões">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
            </button>
            <button class="nav-link <?= Redirect::getPills('#v-pills-senha') ?>" onclick="changeSession('#v-pills-senha')" id="v-pills-senha-tab" data-bs-toggle="pill" data-bs-target="#v-pills-senha" type="button" role="tab" title="Alterar senha">
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
                <div class="tab-pane fade <?= Redirect::getPills('#v-pills-dados', true) ?>" id="v-pills-dados" role="tabpanel">
                    <?php require_once "app/view/formDados.php" ?>
                </div>
                <div class="tab-pane fade <?= Redirect::getPills('#v-pills-endereco', true) ?>" id="v-pills-endereco" role="tabpanel">
                    <?php require_once "app/view/endereco.php" ?>
                </div>
                <div class="tab-pane fade <?= Redirect::getPills('#v-pills-cartao', true) ?>" id="v-pills-cartao" role="tabpanel">...</div>
                <div class="tab-pane fade <?= Redirect::getPills('#v-pills-senha', true) ?>" id="v-pills-senha" role="tabpanel">
                    <?php require_once "app/view/formSenha.php" ?>
                </div>
            </div>
        </div>
    </div>
</main>