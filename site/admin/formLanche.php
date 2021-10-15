<?= Formulario::titulo("Lanches", [
    "controller" => "lanche",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<?php

$textoBotao = "";
$corBotao = "";
$id_Ingredientes = "";
$editar = ["readonly", "disabled"];

if ($aDados["acao"] == "insert" || $aDados["acao"] == "update") {
    $textoBotao = "Gravar";
    $corBotao = "primary";
    $id_Ingredientes = "ingredientes";
    $editar = ["", ""];
} else if ($aDados["acao"] == "delete") {
    $textoBotao = "Exluir";
    $corBotao = "danger";
}

?>

<main class="container">
    <section class="mb-5">
        <form method="POST" action="<?= SITE_URL ?>lanche/<?= $aDados['acao'] ?>">
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select name="id_categoria" class="form-control" id="id_categoria" <?= $editar[0] ?>>
                        <option value="" selected disabled>...</option>
                        <?php foreach ($aDados['categoria'] as $categoria) : ?>
                            <option value="<?= $categoria['id'] ?>" <?= (isset($aDados["data"]) ? ($categoria["id"] == $aDados["data"]["id_categoria"] ? "selected" : "") : "") ?>> <?= $categoria["descricao"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-lg-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" maxlength="250" <?= $editar[0] ?> value="<?= isset($aDados['data']['descricao']) ? $aDados['data']['descricao'] : "" ?>" required placeholder="X-Egge-bacon-burguer">
                </div>

                <div class="col-md-6">
                    <label for="ingredientes" class="form-label">Ingredientes</label>
                    <textarea class="form-control" id="<?= $id_Ingredientes ?>" name="ingredientes" <?= $editar[0] ?> required>
                        <?= isset($aDados['data']['ingredientes']) ? $aDados['data']['ingredientes'] : "" ?>
                    </textarea>
                </div>

                <div class="form-group col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-3">
                            <label for="preco" class="form-label">Preço</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>R$</strong></div>
                                </div>
                                <input type="text" name="preco" id="preco" class="form-control" maxlength="5" <?= $editar[0] ?> value="<?= isset($aDados['data']['preco']) ? $aDados['data']['preco'] : "" ?>" placeholder="00,00">
                            </div>
                        </div>
                        <div class="col-5">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required <?= $editar[1] ?>>
                                <option value="" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == ""  ? "selected" : "") : "") ?>>.....</option>
                                <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?>>Ativo</option>
                                <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?>>Inativo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">

                <div class="form-group col-12 mt-2">
                    <a href="<?= SITE_URL ?>/lanche/lista" class="btn btn-outline-secondary">Voltar</a>
                    <?php if ($acao != "view") : ?>
                        <button id="btn" type="submit" value="submit" class="btn btn-<?= $corBotao ?> me-3"><?= $textoBotao ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</main>


<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector("#ingredientes"))
        .catch(error => {
            console.error(error);
        });

    $(document).ready(function() {
        let ingredientes = CKEDITOR.replace('#ingredientes');

        ingredientes.on('required', function(evt) {
            ingredientes.showNotification('This field is required.', 'warning');
            evt.cancel();
        });
    });

</script>