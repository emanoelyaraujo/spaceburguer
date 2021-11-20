<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= SITE_URL ?>">
                    <img src="<?= SITE_URL ?>assets/img/SVG/spaceburguer2.svg" alt="" width="200" 
                        height="50" class="d-inline-block align-text-top"
                    >
                </a>
            </div>
        </nav>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" 
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon text-danger"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" 
                        href="<?= SITE_URL . (@$_SESSION['userNivel'] == '1' ? "HomeAdmin/index" : "") ?>"
                    >
                        <i class="fas fa-home"></i> 
                        Home
                    </a>
                </li>

                <?php
                if (isset($_SESSION["userId"]))
                {
                    if ($_SESSION["userNivel"] == 1)
                    {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" 
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"
                            >
                                <i class="fas fa-user-lock"></i> 
                                Área Administrativa
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="<?= SITE_URL ?>Categoria/lista">
                                        <i class="fas fa-tags"></i> 
                                        Categorias
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="<?= SITE_URL ?>Lanche/lista">
                                    <i class="fas fa-hamburger"></i> 
                                    Lanches</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= SITE_URL ?>UsuarioAdmin/lista">
                                        <i class="fas fa-users-cog"></i> 
                                        Usuários
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= SITE_URL ?>Home/faleConosco">
                        <i class="fas fa-envelope"></i> 
                        Fale Conosco
                    </a>
                </li>

                <?php

                if (isset($_SESSION["userId"]))
                {
                    if ($_SESSION['userNivel'] == "2")
                    {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>Carrinho/index">
                                <i class="fas fa-shopping-cart"></i> 
                                Carrinho
                            </a>
                        </li>
                        <?php
                    }
                    ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" 
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"
                        >
                            Olá, <?= $_SESSION["userNome"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="<?= SITE_URL ?>MinhaConta/index">
                                    <i class="fas fa-user"></i> 
                                    Minha Conta</a>
                            </li>
                            <?php if ($_SESSION['userNivel'] == "2") : ?>
                                <li>
                                    <a class="dropdown-item" href="<?= SITE_URL ?>Pedido/index">
                                        <i class="fas fa-shopping-bag"></i> 
                                        Meus Pedidos</a>
                                    </li>
                            <?php endif; ?>
                            <hr>
                            <li>
                                <a class="dropdown-item" href="<?= SITE_URL ?>Login/logout">
                                    <i class="fas fa-sign-out-alt"></i> 
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <?php if (!isset($_SESSION["userId"])) : ?>
                <div class="d-flex">
                    <a href="<?= SITE_URL ?>Login/index" class="btn btn-sm btnRoxo">Entrar</a>
                    <a href="<?= SITE_URL ?>Login/cadastrar" class="btn btn-sm btn-outline ms-2 btnLaranja">Cadastre-se</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main style="flex-grow: 1;">