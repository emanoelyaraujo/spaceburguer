<div class="container">
    <div class="row shadow">
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-lg text-center" style="height: 15rem;">
                    <div class="spinner-border text-success m-5" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-10">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" readonly value="<?= isset($_SESSION["userNome"]) ? $_SESSION["userNome"] : "" ?>" required>
                </div>

                <div class="col-md-10">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" readonly value="<?= isset($_SESSION["userEmail"]) ? $_SESSION["userEmail"] : "" ?>" required>
                </div>
                <div class="col-sm-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" readonly value="<?= isset($_SESSION["userTelefone"]) ? $_SESSION["userTelefone"] : "" ?>" required>
                </div>

                <div class="col-sm-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" readonly value="<?= isset($_SESSION["userSenha"]) ? $_SESSION["userSenha"] : "" ?>" required>
                </div>

                <div class="col-sm-3 text-center mt-3">
                    <span class="fs-5">Administrador</span>
                    <img src="https://cdn-icons-png.flaticon.com/512/3064/3064056.png" style="width: 50px;">
                </div>
            </div>
        </div>
    </div>
</div>