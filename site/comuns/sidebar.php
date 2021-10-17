<main>
    <button class="btn btn-outline-link mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <img src="<?= SITE_URL ?>assets/img/SVG/spaceBurguer.svg" width="75%" alt="">
            <button type="button" class="btn btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column flex-shrink-0">
                <div class="p-3 list-inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <a href="#">Home</a>
                </div>
                
                <?php if (!isset($_SESSION["userId"]))
                {
                    ?>
                    <div class="p-3 list-inline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <a href="<?=SITE_URL?>login">Entre ou Cadastre-se</a>
                    </div>
                    <?php
                }
                else
                {
                    if ($_SESSION["userNivel"] == 1)
                    {
                        ?>
                        <div class="p-1 dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                </svg>
                                Área Administrativa
                            </button>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownMenuButton1">
                                <li><a class="text-light dropdown-item" href="<?=SITE_URL?>pedido/lista">Pedidos</a></li>
                                <li><a class="text-light dropdown-item" href="<?=SITE_URL ?>usuarioAdmin/lista">Usuários</a></li>
                                <li><a class="text-light dropdown-item" href="<?=SITE_URL?>lanche/lista">Lanches</a></li>
                                <li><a class="text-light dropdown-item" href="<?=SITE_URL?>categoria/lista">Categorias</a></li>
                            </ul>
                        </div>
                        <?php
                    } else if($_SESSION["userNivel"] == 2)
                    {
                        ?>
                            <div class="p-3 list-inline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <a href="#">Carrinho</a>
                            </div>
                            <div class="p-3 list-inline"><a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    Meus pedidos</a>
                            </div> 
                        <?php
                    }
                }
                ?>

                <div class="p-3 list-inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <a href="<?=SITE_URL?>fale-conosco">Fale conosco</a>
                </div>
                <div class="p-3 list-inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4621b0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <a href="#">Sobre nós</a>
                </div>

                <hr>
                
                <?php
                    if(isset($_SESSION["userId"]))
                    {
                        ?>
                            <div class="dropdown perfil p-4 fixed-bottom">
                                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= SITE_URL ?>assets/img/user.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong><?= $_SESSION["userNome"] ?></strong>
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                    <li><a class="text-light dropdown-item" href="<?= SITE_URL ?>perfil">Perfil</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="text-light dropdown-item" href="<?= SITE_URL ?>usuario/logout">Sair</a></li>
                                </ul>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</main>