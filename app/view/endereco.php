<section>
    <h4 class="mb-3">Meus Endereços</h4>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color:#433A8F;">Adicione seu Endereço</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="p-3" method="post" action="<?= SITE_URL ?>MinhaConta/insertEndereco">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nomeEndereco">Nome do Endereço<span>*</span></label>
                                    <input type="text" name="nomeEndereco" class="form-control" maxlength="60" id="nomeEndereco" autofocus required>
                                    <small>Exemplo: minha casa</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="cep">CEP<span>*</span></label>
                                    <input type="text" name="cep" class="form-control" maxlength="9" id="cep" autofocus required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="rua">Rua<span>*</span></label>
                                    <input type="text" name="rua" maxlength="50" class="form-control" id="rua" autofocus required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-gro mb-3">
                                    <label for="bairro">Bairro<span>*</span></label>
                                    <input type="text" name="bairro" maxlength="50" class="form-control" id="bairro" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="numero">Número<span>*</span></label>
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
                                        <button class="btn btn-primary" type="submit" id="entrar" title="Cadastrar">Salvar Informações</button>
                                    </div>
                                    <div class="p-2 bd-highlight text-center">
                                        <a href="">Close</a>
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
            <div class="p-1">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $endereco["nomeEndereco"] ?></h5>
                        <p class="card-text">
                            <?= $endereco["rua"] . ", " . $endereco["numero"] .
                            "<br>" . $endereco["bairro"] . ", " . $endereco["cep"] ?>
                        </p>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a class="text-decoration-none text-dark me-2" href="">
                                <img src="<?= SITE_URL ?>assets/img/SVG/edit.svg" alt="">Editar
                            </a>
                            <a class="text-decoration-none text-dark" href="">
                                <img src="<?= SITE_URL ?>assets/img/SVG/trash.svg" alt="">Excluir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Adicionar novo Endereço
        </button>
    </div>
</section>