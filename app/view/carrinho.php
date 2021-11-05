<?php if (empty($pedido)) : ?>
    <div class="d-flex justify-content-center mt-4">
        <div class="container text-center">
            <span><img src="<?= SITE_URL ?>assets/img/SVG/shopping-cart.svg" alt=""></span>
            <h4 class="mt-2">Seu carrinho está vazio</h4>
            <p>Adicione lanches clicando no botão “ADICIONAR AO CARRINHO” na página principal.</p>
            <a href="<?= SITE_URL ?>" class="btn btn-sm btnLaranja mt-3">VOLTAR PARA A PÁGINA INICIAL</a>
        </div>
    </div>
<?php endif; ?>
