<section>
    <h2 class="mb-3">Endereços</h2>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo" style="color:#433A8F;">Adicionar Endereço</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="p-3" method="post" action="<?= SITE_URL ?>MinhaConta/insertEndereco">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nomeEndereco">Nome do Endereço<span class='text-danger fw-bolder'>*</span></label>
                                    <input type="text" name="nomeEndereco" class="form-control" maxlength="60" 
                                        id="nomeEndereco" autofocus required
                                    >
                                    <small>Exemplo: minha casa</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="cep">CEP<span class='text-danger fw-bolder'>*</span></label>
                                    <input type="text" name="cep" class="form-control" maxlength="9" id="cep" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="rua">Rua<span class='text-danger fw-bolder'>*</span></label>
                                    <input type="text" name="rua" maxlength="50" class="form-control" id="rua" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-gro mb-3">
                                    <label for="bairro">Bairro<span class='text-danger fw-bolder  '>*</span></label>
                                    <input type="text" name="bairro" maxlength="50" class="form-control" id="bairro" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="numero">Número<span class='text-danger fw-bolder  '>*</span></label>
                                    <input type="text" name="numero" maxlength="4" class="form-control" id="numero" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" maxlength="50" class="form-control" name="complemento" id="complemento">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="d-flex flex-column bd-highlight justify-content-center mb-3">
                                    <div class="p-2 bd-highlight">
                                        <button class="btn btnRoxo btnPerfil" type="submit" id="entrar" title="Cadastrar">
                                            SALVAR INFORMAÇÕES
                                        </button>
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
        <?php foreach ($dados["endereco"] as $endereco) : ?>
            <div class="p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $endereco["nomeEndereco"] ?></h5>
                        <p class="card-text">
                            <?= $endereco["rua"] . ", " . $endereco["numero"] .
                                "<br>" . $endereco["bairro"] . ", " . $endereco["cep"] ?>
                        </p>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a class="text-decoration-none text-dark me-3 acaoEndereco" 
                                onclick="acaoEndereco(<?= $endereco['id'] ?>, 'update')"
                            >
                                <img src="<?= SITE_URL ?>assets/img/SVG/edit.svg" alt="">
                                Editar
                            </a>
                            <?php if (count($dados["endereco"]) > 1) : ?>
                                <a class="text-decoration-none text-dark acaoEndereco" 
                                    onclick="acaoEndereco(<?= $endereco['id'] ?>, 'delete')"
                                >
                                    <img src="<?= SITE_URL ?>assets/img/SVG/trash.svg" alt="">
                                    Excluir
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <button type="button" class="btn btnRoxo btnPerfil mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            ADICIONAR NOVO ENDEREÇO
        </button>
    </div>
</section>

<script>
    var myModal = document.getElementById("staticBackdrop")
    myModal.addEventListener('hidden.bs.modal', function() {
        $("#nomeEndereco").val("")
        $("#cep").val("")
        $("#rua").val("")
        $("#bairro").val("")
        $("#numero").val("")
        $("#complemento").val("")

        $("form").prop("action", "<?= SITE_URL ?>MinhaConta/insertEndereco")
        $("#titulo").html("Adicionar Endereço")
        $("#entrar").html("SALVAR INFORMAÇÕES")
    })

    function acaoEndereco(id, acao) {
        $.get(`<?= SITE_URL ?>/MinhaConta/carregaDadosEndereco&id=${id}`).done((response) => {
            response = JSON.parse(response)

            $("#nomeEndereco").val(response.nomeEndereco)
            $("#cep").val(response.cep)
            $("#rua").val(response.rua)
            $("#bairro").val(response.bairro)
            $("#numero").val(response.numero)
            $("#complemento").val(response.complemento)
        })

        if (acao == "update") {
            $("form").prop("action", `<?= SITE_URL ?>MinhaConta/updateEndereco&id=${id}`)
            $("#titulo").html("Editar Endereço")
            $("#entrar").html("EDITAR INFORMAÇÕES")
        } else {
            $("form").prop("action", `<?= SITE_URL ?>MinhaConta/deleteEndereco&id=${id}`)
            $("#entrar").html("EXCLUIR INFORMAÇÕES")
        }

        var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"))
        myModal.show()
    }
</script>