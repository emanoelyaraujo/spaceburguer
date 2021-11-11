<script>
    $(document).ready(function() {
        $("#numeroCartao").mask('0000 0000 0000 0000');
    });
</script>

<section>
    <h2 class="mb-3">Cartões</h2>
    <div class="modal fade" id="modalCartao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal" style="color:#433A8F;">Adicionar Cartão</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="p-3" method="post" action="<?= SITE_URL ?>MinhaConta/insertCartao">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="numeroCartao">Número<span class="spanRed">*</span></label>
                                    <input type="text" name="numeroCartao" class="form-control" id="numeroCartao" autofocus required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nomeCartao">Nome<span class="spanRed">*</span></label>
                                    <input type="text" name="nomeCartao" class="form-control text-uppercase" maxlength="20" id="nomeCartao" autofocus required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="data">Vencimento<span class="spanRed">*</span></label>
                                    <input type="month" class="form-control" name="data" min="<?= date("Y-m") ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tipo">Tipo<span class="spanRed">*</span></label>
                                    <select class="form-select" name="tipo" aria-label="Default select example">
                                        <option value="C" selected>Crédito</option>
                                        <option value="D">Débito</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-gro mb-3">
                                    <label for="cvv">CVV<span class="spanRed">*</span></label>
                                    <input type="password" name="cvv" maxlength="3" minlength="3" class="form-control" id="cvv" autofocus required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="d-flex flex-column bd-highlight justify-content-center mb-3">
                                    <div class="p-2 bd-highlight">
                                        <button class="btn btnRoxo btnPerfil" type="submit" id="entrar" title="Cadastrar">SALVAR INFORMAÇÕES</button>
                                    </div>
                                    <div class="p-2 bd-highlight text-center">
                                        <a href="">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-group">
        <?php foreach ($dados["cartao"] as $cartao) : ?>
            <div class="p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase"><?= $cartao["nome"] ?></h5>
                        <p class="card-text" id="numeroCartao">
                            <?= $cartao["numero"] ?>
                        </p>
                        <p class="card-text">
                            <?= $cartao["tipo"] == "D" ? "Débito" : "Crédito" ?>
                        </p>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a class="text-decoration-none text-dark me-3 acaoCartao" onclick="acaoCartao(<?= $cartao['id'] ?>, 'update')">
                                <img src="<?= SITE_URL ?>assets/img/SVG/edit.svg" alt="">Editar
                            </a>
                            <?php if (count($dados["cartao"]) > 1) : ?>
                                <a class="text-decoration-none text-dark acaoCartao" onclick="acaoCartao(<?= $cartao['id'] ?>, 'delete')">
                                    <img src="<?= SITE_URL ?>assets/img/SVG/trash.svg" alt="">Excluir
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <button type="button" class="btn btnRoxo btnPerfil" data-bs-toggle="modal" data-bs-target="#modalCartao">
            ADICIONAR NOVO CARTÃO
        </button>
    </div>
</section>

<script>
    var myModal = document.getElementById("modalCartao")
    myModal.addEventListener('hidden.bs.modal', function() {
        $("#numeroCartao").val("")
        $(".form-group #nomeCartao").val("")
        $("#data").val("")
        $("#cvv").val("")
        $("#tipo").val("")

        $("form").prop("action", "<?= SITE_URL ?>MinhaConta/insertCartao")
        $("#tituloModal").html("Adicionar Cartão")
        $("#entrar").html("SALVAR INFORMAÇÕES")
        $("label[for=cvv]").removeClass("invisible")
        $("input[name=cvv]").removeClass("invisible")
        $('input[name=cvv]').attr("required")
    })

    function acaoCartao(id, acao) {
        $.get(`<?= SITE_URL ?>/MinhaConta/carregaDadosCartao&id=${id}`).done((response) => {
            response = JSON.parse(response)

            $("#numeroCartao").val(response.numero)
            $(".form-group #nomeCartao").val(response.nome)
            $("#data").val(response.vencimento)
            $("#cvv").val("")
            $("#tipo").value(response.tipo)
        })

        if (acao == "update") {
            $("form").prop("action", `<?= SITE_URL ?>MinhaConta/updateCartao&id=${id}`)
            $("#tituloModal").html("Editar Cartão")
            $("#entrar").html("EDITAR INFORMAÇÕES")
            $("label[for='cvv']").addClass("invisible")
            $("#cvv").addClass("invisible")
            $('#cvv').removeAttr('required')
        } else {
            $("form").prop("action", `<?= SITE_URL ?>MinhaConta/deleteCartao&id=${id}`)
            $("#entrar").html("EXCLUIR INFORMAÇÕES")
        }

        var myModal = new bootstrap.Modal(document.getElementById("modalCartao"))
        myModal.show()
    }
</script>