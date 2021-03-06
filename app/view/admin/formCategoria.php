<?= Formulario::titulo("Categorias", [
    "controller" => "categoria",
    "btNovo" => false,
    "acao" => $aDados['acao']
]) ?>

<section class="container mb-5">
    <form method="POST" action="<?= SITE_URL ?>categoria/<?= $aDados['acao'] ?>">
        <div class="row">
            <div class="form-group col-lg-4 col-sm-6">
                <label for="descricao" class="form-label">Descrição <span class='fw-bold text-danger'>*</span></label>
                <input type="text" name="descricao" id="descricao" class="form-control" maxlength="100" 
                    <?= Helpers::$acoesInput[$aDados['acao']]['readonly'] ?> 
                    value="<?= isset($aDados['data']['descricao']) ? $aDados['data']['descricao'] : "" ?>" 
                    required placeholder="Salgados, doces, bebidas..."
                >
            </div>
            <div class="form-group col-lg-4 col-sm-4">
                <label for="status" class="form-label">Status <span class='fw-bold text-danger'>*</span></label>
                <select name="status" id="status" class="form-control" required <?= Helpers::$acoesInput[$aDados['acao']]['disabled'] ?>>
                    <option value=""></option>
                    <option value="1" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "1" ? "selected" : "") : "") ?>>
                        Ativo
                    </option>
                    <option value="2" <?= (isset($aDados['data']['status']) ? ($aDados['data']['status'] == "2" ? "selected" : "") : "") ?>>
                        Inativo
                    </option>
                </select>
            </div>
            <input type="hidden" name="id" value="<?= isset($aDados['data']['id']) ? $aDados['data']['id'] : "" ?>">
            <div class="form-group mt-4">
                <a href="<?= SITE_URL ?>/categoria/lista" class="btn btn-outline-secondary">Voltar</a>
                <?php if ($acao != "view") : ?>
                    <button type="submit" value="submit" class="btn btn-<?= Helpers::$botoes[$aDados['acao']]['corBotao'] ?>">
                        <?= Helpers::$botoes[$aDados['acao']]['textoBotao'] ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</section>