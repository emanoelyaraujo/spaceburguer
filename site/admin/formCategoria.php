<?= Formulario::titulo("Categorias", [
    "controller" => "categoria",
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
        <form method="POST" action="<?= SITE_URL ?>categoria/<?= $aDados['acao'] ?>">
            <div class="row">
                <div class="form-group col-md-8 mb-3">
                    <label for="imagem" class="form-label">Link Imagem</label>
                    <input type="text" name="imagem" id="imagem" class="form-control" maxlength="250"
                        <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "readonly" : "") : "") ?>
                        value="<?= isset($aDados['data']['imagem']) ? $aDados['data']['imagem'] : "" ?>" 
                        required autofocus placeholder="Tamanho recomendado 128px"
                    >
                </div>

                <div class="form-group col-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required
                        <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "disabled" : "") : "") ?> >
                        <option value="" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == ""  ? "selected" : "") : "") ?> >.....</option>
                        <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?> >Ativo</option>
                        <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?> >Inativo</option>
                    </select>
                </div>

                <div class="form-group col-md-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" maxlength="100" 
                    <?= (isset($aDados['acao']) ? ($aDados['acao'] == 'view' || $aDados['acao'] == 'delete' ? "readonly" : "") : "")?> 
                        value="<?= isset($aDados['data']['descricao']) ? $aDados['data']['descricao'] : "" ?>" 
                        required placeholder="Salgados, doces, bebidas..."
                    >
                </div>

                <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">

                <div class="form-group col-12 mt-2">
                    <a href="<?= SITE_URL ?>/categoria/lista" class="btn btn-outline-secondary">Voltar</a>
                    <?php if($acao != "view"): ?>     
                        <button type="submit" value="submit" class="btn btn-<?= $corBotao ?> me-3"><?= $textoBotao ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</main>