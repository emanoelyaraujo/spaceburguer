<?php

class Lista
{    
    /**
     * monta a lista dos cruds do adm
     *
     * @param  string $controller
     * @param  array $thead
     * @param  array $tbody
     * @param  array $id
     * @return void
     */
    public static function montaLista($controller, $thead, $tbody, $id)
    {
        ?>
        <div class="container">
            <section class="login_box_area mb-5">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-light table-sm" id="tblLista">
                        <thead>
                            <tr class="text-weigth-bold">
                                <?php foreach ($thead as $th) : ?>
                                    <th><?= $th ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php foreach ($tbody as $key => $row) : ?>
                                <tr>
                                    <?php foreach ($row as $col) : ?>
                                        <td><?= $col ?></td>
                                    <?php endforeach; ?>
                                    <td class="text-center">
                                        <a href="<?= SITE_URL ?>/<?= $controller ?>/form/view/<?= (implode("", $id[$key])) ?>" class="btn btn-secondary btn-sm" title="Visualizar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a href="<?= SITE_URL ?>/<?= $controller ?>/form/update/<?= (implode("", $id[$key])) ?>" class="btn btn-secondary btn-sm" title="Alterar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <a href="<?= SITE_URL ?>/<?= $controller ?>/form/delete/<?= (implode("", $id[$key])) ?>" class="btn btn-secondary btn-sm" title="Excluir">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <?php
    }
}
