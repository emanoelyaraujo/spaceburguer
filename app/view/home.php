<script>
    function addCarrinho(id) {

        const codUsuario = <?= isset($_SESSION["userId"]) ? $_SESSION["userId"] : 0 ?>

        if (codUsuario) {
            $.post("/Carrinho/addCarrinho", {
                id
            }).done(function(response) {
                response = JSON.parse(response)
                if (response.status) {
                    msgSucesso(response.mensagem);
                } else {
                    msgError(response.mensagem);
                }
            })
        } else {
            window.location = "<?= SITE_URL ?>Login/index";
        }
    }
</script>

<section>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= SITE_URL ?>assets/img/carrossel01.png" class="d-none d-md-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= SITE_URL ?>assets/img/carrossel02.png" class="d-none d-md-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= SITE_URL ?>assets/img/carrossel03.png" class="d-none d-md-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev d-none d-md-block" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next d-none d-md-block" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<div class="trends">
    <div class="bbb_background"></div>
    <div class="container">
        <h1 class="d-block">Olá, <div id="nomeUsuario"><?= (isset($_SESSION["userNome"]) ? $_SESSION["userNome"] : "") ?></div>
        </h1>
        <h4>Que tal comprar um lanche hoje?</h4>
        <?php

        $categoria = "";

        foreach ($dados as $key => $lanches)
        {
            $flag = $lanches["descricao"] != @$dados[$key + 1]["descricao"];

            if ($key == 0 || $lanches["descricao"] != $categoria)
            {
        ?>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="bbb_container">
                            <p>Categoria</p>
                            <h2 class=""><?= $lanches["descricao"] ?></h2>
                            <div class="bbb_slider_nav">
                                <div class="bbb_prev bbb_nav" onclick="voltar(<?= $key ?>)"><i class="fas fa-angle-left ml-auto"></i></div>
                                <div class="bbb_next bbb_nav" onclick="ir(<?= $key ?>)"><i class="fas fa-angle-right ml-auto"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="bbb_slider_container">
                            <div class="owl-carousel owl-theme bbb_slider" id="bbb_slider<?= $key ?>">
                            <?php
                        }

                        $categoria = $lanches["descricao"];
                            ?>

                            <div class="owl-item">
                                <div class="bbb_item is_new">
                                    <ul class="bbb_marks">
                                        <li class="bbb_mark bbb_new">new</li>
                                    </ul>
                                    <div class="bbb_image d-flex flex-column align-items-center justify-content-center"><img src="<?= $lanches["imagem"] ?>" alt=""></div>
                                    <div class="bbb_content">
                                        <div class="bbb_info clearfix">
                                            <p><b><?= $lanches["nome"] ?></b></p>
                                            <p>R$ <?= $lanches["preco"] ?></p>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto mt-3">
                                        <button class="btn btnRoxo" onclick="addCarrinho(<?= $lanches['id'] ?>)" type="button">Adicionar ao Carrinho</button>
                                    </div>
                                </div>
                            </div>
                            <?php

                            if (count($dados) == ($key - 1) || $flag)
                            {
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
                            }
                        }
        ?>
    </div>
</div>

<script>
    function voltar(key) {
        $(`#bbb_slider${key}`).trigger('prev.owl.carousel');
    }

    function ir(key) {
        $(`#bbb_slider${key}`).trigger('next.owl.carousel');
    }

    $(document).ready(function() {

        if ($('.bbb_slider').length) {
            var trendsSlider = $('.bbb_slider');

            trendsSlider.owlCarousel({
                loop: false,
                margin: 30,
                nav: false,
                dots: false,
                autoplayHoverPause: true,
                autoplay: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    991: {
                        items: 3
                    }
                }
            });

            trendsSlider.on('click', '.bbb_fav', function(ev) {
                $(ev.target).toggleClass('active');
            });
        }
    });
</script>