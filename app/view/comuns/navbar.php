<style>
    
</style>

<main>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= SITE_URL ?>">
                        <img src="<?= SITE_URL ?>assets/img/SVG/spaceburguer2.svg" alt="" width="200" height="50" class="d-inline-block align-text-top">
                    </a>
                </div>
            </nav>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-danger"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="d-flex navbar-nav me-auto mb-2 mb-lg-0 w-100">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>

                    <?php  
                        if (isset($_SESSION["userId"]))
                        {
                            if ($_SESSION["userNivel"] == 1)
                            {
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Área Administrativa
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a class="dropdown-item" href="<?= SITE_URL ?>Categoria/lista">Categorias</a></li>
                                            <li><a class="dropdown-item" href="<?= SITE_URL ?>Lanche/lista">Lanches</a></li>
                                            <li><a class="dropdown-item" href="<?= SITE_URL ?>UsuarioAdmin/lista">Usuários</a></li>
                                        </ul>
                                    </li>
                                <?php
                            }else if($_SESSION["userNivel"] == 2)
                            {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= SITE_URL ?>Carrinho/index">Carrinho</a>
                                </li>
                                <?php
                            }
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= SITE_URL ?>Home/faleConosco">Fale Conosco</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre nós</a>
                    </li>
                    <?php
                    if(isset($_SESSION["userId"]))
                    {
                        ?>
                        
                        <div class="ms-md-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_SESSION["userNome"] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="<?= SITE_URL ?>MinhaConta/index">Minha Conta</a></li>
                                    <li><a class="dropdown-item" href="<?= SITE_URL ?>MinhaConta/index">Meus Pedidos</a></li>
                                    <hr>
                                    <li><a class="dropdown-item" href="<?= SITE_URL ?>Login/logout">Sair</a></li>
                                </ul>
                            </li>
                        </div>
                        <?php
                    }
                    ?>
                </ul>
 
                <?php if (!isset($_SESSION["userId"])): ?>
                    <div class="d-flex">
                        <a href="<?= SITE_URL ?>Login/index" class="btn btn-sm btnRoxo">Entrar</a>
                        <a href="<?= SITE_URL ?>Login/cadastrar" class="btn btn-sm btn-outline ms-2 btnLaranja">Cadastre-se</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</main>