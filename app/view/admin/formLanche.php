<?= Formulario::titulo("Lanches", [
    "controller" => "lanche",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<div class="col-12">
    <?= Formulario::exibeMsgError() ?>
</div>

<main class="container">
    <section class="mb-5">
        <form method="POST" action="<?= SITE_URL ?>lanche/<?= $aDados['acao'] ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select name="id_categoria" class="form-control" required id="id_categoria" <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?>>
                        <option value="" selected disabled></option>
                        <?php foreach ($aDados['categoria'] as $categoria) : ?>
                            <option value="<?= $categoria['id'] ?>" <?= (isset($aDados["data"]) ? ($categoria["id"] == $aDados["data"]["id_categoria"] ? "selected" : "") : "") ?>> <?= $categoria["descricao"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-lg-6 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" maxlength="250" <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> value="<?= isset($aDados['data']['descricao']) ? $aDados['data']['descricao'] : "" ?>" required placeholder="X-Egge-bacon-burguer">
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ingredientes" class="form-label">Ingredientes</label>
                        <?php if ($aDados["acao"] == "view" || $aDados["acao"] == "delete") : ?>
                            <?= $aDados['data']['ingredientes'] ?>
                        <?php else : ?>
                            <textarea name="ingredientes" id="ingredientes" <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> required>
                                <?= isset($aDados['data']['ingredientes']) ? $aDados['data']['ingredientes'] : "" ?>
                            </textarea>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-6 col-sm-3">
                            <label for="preco" class="form-label">Preço</label>
                            <div class="input-group mb-2">
                                <input type="text" name="preco" id="preco" class="form-control text-end" onKeyUp="mask_valor(this,event,'##.###.###.###,##',true)" <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> value="<?= isset($aDados['data']['preco']) ? Numeros::formataValor($aDados['data']['preco']) : "" ?>">
                            </div>
                        </div>
                        <div class="col-8 col-sm-5">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required <?= Helpers::$acoesInput[$aDados['acao']]['disabled'] ?>>
                                <option value="" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == ""  ? "selected disabled" : "") : "") ?>>.....</option>
                                <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?>>Ativo</option>
                                <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?>>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-8 mb-3">
                            <label for="imagem" class="form-label">Imagem</label><br>
                            <input type="file" class="form-control" name="imagem" id="imagem" accept="image/png, image/jpeg, image/jpg"
                                <?= $aDados['acao'] == 'insert' ? 'required' : '' ?>
                            >
                            <?php if(!empty($aDados['data']['imagem'])): ?>
                                <img src="<?= SITE_URL . 'uploads/lanches/' . $aDados['data']['imagem']?>" class="img-thumbnail mt-3" width="200" alt="Imagem do lanche">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">
                <input type="hidden" name="nomeImagem" value="<?= isset($aDados['data']['imagem']) ? $aDados['data']['imagem'] : "" ?>">

                <div class="form-group col-12 mt-3">
                    <a href="<?= SITE_URL ?>/lanche/lista" class="btn btn-outline-secondary">Voltar</a>
                    <?php if ($acao != "view") : ?>
                        <button id="btn" type="submit" value="submit" class="btn btn-<?= Helpers::$botoes[$aDados['acao']]['corBotao'] ?> me-3"><?= Helpers::$botoes[$aDados['acao']]['textoBotao'] ?></button>
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