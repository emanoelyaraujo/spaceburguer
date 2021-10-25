<?= Formulario::titulo("Lanches", [
    "controller" => "lanche",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<?php

$textoBotao = "";
$corBotao = "";
$id_Ingredientes = "";
$editar = ["readonly" => "readonly", "disabled" => "disabled"];

if ($aDados["acao"] == "insert" || $aDados["acao"] == "update")
{
    $textoBotao = "Gravar";
    $corBotao = "primary";
    $id_Ingredientes = "ingredientes";
    $editar = ["readonly" => "", "disabled" => ""];
}
else if ($aDados["acao"] == "delete")
{
    $textoBotao = "Exluir";
    $corBotao = "danger";
}

?>

<div class="col-12">
    <?= Formulario::exibeMsgError() ?>
</div>

<main class="container">
    <section class="mb-5">
        <form method="POST" action="<?= SITE_URL ?>lanche/<?= $aDados['acao'] ?>">
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select name="id_categoria" class="form-control" required id="id_categoria" <?= $editar["readonly"] ?>>
                        <option value="" selected disabled></option>
                        <?php foreach ($aDados['categoria'] as $categoria) : ?>
                            <option value="<?= $categoria['id'] ?>" <?= (isset($aDados["data"]) ? ($categoria["id"] == $aDados["data"]["id_categoria"] ? "selected" : "") : "") ?>> <?= $categoria["descricao"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-lg-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" maxlength="250" <?= $editar["readonly"] ?> value="<?= isset($aDados['data']['descricao']) ? $aDados['data']['descricao'] : "" ?>" required placeholder="X-Egge-bacon-burguer">
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ingredientes" class="form-label">Ingredientes</label>
                        <?php if($aDados["acao"] == "view" || $aDados["acao"] == "delete"): ?>
                            <?= $aDados['data']['ingredientes'] ?>
                        <?php else: ?>
                            <textarea name="ingredientes"id="<?= $id_Ingredientes ?>" <?= $editar["readonly"] ?> required>
                                <?= isset($aDados['data']['ingredientes']) ? $aDados['data']['ingredientes'] : "" ?>
                            </textarea>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-3">
                            <label for="preco" class="form-label">Preço</label>
                            <div class="input-group mb-2">
                                <input type="text" name="preco" id="preco" class="form-control text-end" 
                                    onKeyUp="mask_valor(this,event,'##.###.###.###,##',true)" 
                                    <?= $editar["readonly"] ?> 
                                    value="<?= isset($aDados['data']['preco']) ? Numeros::formataValor($aDados['data']['preco']) : "" ?>">
                            </div>
                        </div>
                        <div class="col-5">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required <?= $editar["disabled"] ?>>
                                <option value="" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == ""  ? "selected" : "") : "") ?>>.....</option>
                                <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?>>Ativo</option>
                                <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?>>Inativo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">

                <div class="form-group col-12 mt-3">
                    <a href="<?= SITE_URL ?>/lanche/lista" class="btn btn-outline-secondary">Voltar</a>
                    <?php if ($acao != "view") : ?>
                        <button id="btn" type="submit" value="submit" class="btn btn-<?= $corBotao ?> me-3"><?= $textoBotao ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</main>

<script src="<?= SITE_URL ?>assets/js/mascara.js">

</script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector("#ingredientes"))
        .catch(error => {
            console.error(error);
        });
</script>