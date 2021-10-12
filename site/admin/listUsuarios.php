<?= Formulario::titulo("Lista Usuário", [
    "controller" => "usuario",
]) ?>

<div class="container">

    <section class="login_box_area mb-5">
        <div class="table-responsive">

            <table class="table table-hover table-bordered table-striped table-sm">
                <thead>
                    <tr class="text-weigth-bold">
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Nível</th>
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aDados['data'] as $value) : ?>
                        <tr>
                            <td><?= $value['nome'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= ($value['nivel'] == 1 ? "Administrador" : "Visitante") ?></td>
                            <td><?= ($value['status'] == 1 ? "Ativo" : "Inativo") ?></td>
                            <td>
                                <a href="<?= SITE_URL ?>/usuario/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar">
                                    <i class="fa fa-eye" area-hidden="true"></i>Visualizar
                                </a>
                                <a href="<?= SITE_URL ?>/usuario/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar">
                                    <i class="fa fa-file" area-hidden="true"></i>Alterar
                                </a>
                                <a href="<?= SITE_URL ?>/usuario/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir">
                                    <i class="fa fa-trash" area-hidden="true"></i>Deletar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>
</div>