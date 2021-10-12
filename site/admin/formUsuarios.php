<?= Formulario::titulo("Usuário", [
    "controller" => "usuario",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<main class="container">

    <section class="mb-5">

        <form method="POST" action="<?= SITE_URL ?>usuario/<?= $aDados['acao'] ?>">

            <div class="row">

                <div class="form-group col-12 col-md-8">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" maxlength="50" 
                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('readonly');
                        }
                    ?>
                    value="<?= isset($aDados['data']['nome']) ? $aDados['data']['nome'] : "" ?>" required autofocus placeholder="Nome completo do usuário">
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control"
                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('disabled');
                        }
                    ?>
                    required>
                        <option value="" <?= isset($aDados['data']['status']) ? $aDados['data']['status'] == ""  ? "selected" : "" : "" ?>>.....</option>
                        <option value="1" <?= isset($aDados['data']['status']) ? $aDados['data']['status'] == "1" ? "selected" : "" : "" ?>>Ativo</option>
                        <option value="2" <?= isset($aDados['data']['status']) ? $aDados['data']['status'] == "2" ? "selected" : "" : "" ?>>Inativo</option>
                    </select>
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" maxlength="100" 
                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('readonly');
                        }
                    ?>
                    value="<?= isset($aDados['data']['email']) ? $aDados['data']['email'] : "" ?>" required placeholder="E-mail: seu-nome@dominio.com">
                </div>

                <div class="form-group col-12 col-md-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" maxlength="11" 
                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('readonly');
                        }
                    ?>
                    value="<?= isset($aDados['data']['telefone']) ? $aDados['data']['telefone'] : "" ?>" autofocus placeholder="(00) 00000-0000">
                </div>

                <div class="form-group col-12 col-md-3">
                    <label for="nivel" class="form-label">Nível</label>
                    <select name="nivel" id="nivel" class="form-control"
                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('disabled');
                        }
                    ?>

                    required>
                        <option value="" <?= isset($aDados['data']['nivel']) ? $aDados['data']['nivel'] == ""    ? "selected" : "" : "" ?>>.....</option>
                        <option value="1" <?= isset($aDados['data']['nivel']) ? $aDados['data']['nivel'] == "1"   ? "selected" : "" : "" ?>>Administrador</option>
                        <option value="2" <?= isset($aDados['data']['nivel']) ? $aDados['data']['nivel'] == "2"  ? "selected" : "" : "" ?>>Usuário</option>
                        <option value="3" <?= isset($aDados['data']['nivel']) ? $aDados['data']['nivel'] == "3"  ? "selected" : "" : "" ?>>Motoboy</option>
                    </select>
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" maxlength="250"

                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('readonly');
                        }
                    ?>
                    value="<?= isset($aDados['data']['senha']) ? $aDados['data']['senha'] : "" ?>" required placeholder="Informe uma senha">
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="confSenha" class="form-label">Conferir a senha</label>
                    <input type="password" name="confSenha" id="confSenha" class="form-control" maxlength="250"
                    <?php 
                        if (isset($aDados['acao']) && $aDados['acao'] == 'view' or $aDados['acao'] == 'delete'){
                            echo ('readonly');
                        }
                    ?>
                    value="<?= isset($aDados['data']['senha']) ? $aDados['data']['senha'] : "" ?>" required placeholder="Confirme a senha">
                </div>

                <div class="form-group col-12 col-md-4 mt-2">

                    <?php if ($acao != "view") : ?>

                        <?php if ($acao != 'delete'){ ?>

                            <button type="submit" value="submit" class="btn btn-success me-3">Gravar</button>

                        <?php }else{ ?>

                            <button type="submit" value="submit" class="btn btn-danger me-3">Deletar</button>

                        <?php }

                        endif; ?>

                        <?php if ($acao != "view"){ ?>

                            <a href="<?= SITE_URL ?>/Usuario/lista" class="btn btn-outline-warning">Voltar</a>

                        <?php }else { ?>

                            <a href="<?= SITE_URL ?>/Usuario/lista" class="btn btn-warning">Voltar</a>

                        <?php } ?>

                </div>

            </div>

        </form>

    </section>

</main>