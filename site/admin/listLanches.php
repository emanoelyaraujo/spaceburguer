<?= Formulario::titulo("Lista lanches", [
    "controller" => "lanche",
]) ?>

<div class="container">

    <section class="login_box_area mb-5">
        <div class="table-responsive">

            <table class="table table-hover table-bordered table-striped table-sm text-center">
                <thead>
                    <tr class="text-weigth-bold">
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aDados['data'] as $value) : ?>
                        <tr>
                            <td>
                                <?php
                                foreach ($aDados['categoria'] as $categoria) {
                                    if ($value['id_categoria'] == $categoria['id']) {
                                        echo ($categoria['descricao']);
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $value['descricao'] ?></td>
                            <td>R$ <?= str_replace(".",",", $value['preco']) ?></td>
                            <td><?= ($value['status'] == 1 ? "Ativo" : "Inativo") ?></td>
                            <td>
                                <a href="<?= SITE_URL ?>/lanche/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="<?= SITE_URL ?>/lanche/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <a href="<?= SITE_URL ?>/lanche/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </a>
                            </td>
                        </trry>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>