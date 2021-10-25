<?= Formulario::titulo("Usuário", [
    "controller" => "usuarioAdmin",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<?php

$textoBotao = "";
$corBotao = "";

if ($aDados["acao"] == "insert" || $aDados["acao"] == "update")
{
    $textoBotao = "Gravar";
    $corBotao = "primary";
}
else if ($aDados["acao"] == "delete")
{
    $textoBotao = "Exluir";
    $corBotao = "danger";
}

?>

<main class="container">
    <section class="mb-5">
        <form method="POST" action="<?= SITE_URL ?>usuarioAdmin/<?= $aDados['acao'] ?>">
            <div class="row">
                <div class="form-group col-12 col-md-8 mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" maxlength="50"
                        <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "readonly" : "") : "") ?>
                        value="<?= isset($aDados['data']['nome']) ? $aDados['data']['nome'] : "" ?>" 
                        required autofocus placeholder="Nome completo do usuário"
                    >
                </div>

                <div class="form-group col-12 col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required
                        <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "disabled" : "") : "") ?> >
                        <option value="" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == ""  ? "selected" : "") : "") ?> >.....</option>
                        <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?> >Ativo</option>
                        <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?> >Inativo</option>
                    </select>
                </div>

                <div class="form-group col-12 col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" maxlength="100" 
                    <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "readonly" : "") : "")?> 
                        value="<?= isset($aDados['data']['email']) ? $aDados['data']['email'] : "" ?>" 
                        required placeholder="exemplo@dominio.com"
                    >
                </div>

                <div class="form-group col-12 col-md-3 mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" minlength="11" maxlength="15"
                        <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "readonly" : "") : "")?> 
                        value="<?= isset($aDados['data']['telefone']) ? $aDados['data']['telefone'] : "" ?>" 
                        autofocus placeholder="(00) 00000-0000"
                    >
                </div>

                <div class="form-group col-12 col-md-3 mb-3">
                    <label for="nivel" class="form-label">Nível</label>
                    <select name="nivel" id="nivel" class="form-control" required
                    <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "disabled" : "") : "") ?> >
                        <option value="" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == ""    ? "selected" : "") : "") ?>>.....</option>
                        <option value="1" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == "1"   ? "selected" : "") : "") ?>>Administrador</option>
                        <option value="2" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == "2"  ? "selected" : "") : "") ?>>Usuário</option>
                        <option value="3" <?= (isset($aDados['data']['nivel']) ? ($aDados['data']['nivel'] == "3"  ? "selected" : "") : "") ?>>Motoboy</option>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">

                <div class="form-group col-12 col-md-4 mt-2">
                    <a href="<?= SITE_URL ?>/usuarioAdmin/lista" class="btn btn-outline-secondary">Voltar</a>
                    <?php if($acao != "view"): ?>     
                        <button type="submit" value="submit" class="btn btn-<?= $corBotao ?> me-3"><?= $textoBotao ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</main>