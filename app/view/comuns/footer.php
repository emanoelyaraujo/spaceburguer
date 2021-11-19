</main>
<footer class="pt-4 mb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h2 class="mb-2">
                    <img src="<?= SITE_URL ?>assets/img/SVG/spaceBurguer.svg" width="250" alt="">
                </h2>
                <p class="menu">
                    <a href="<?= SITE_URL ?>">Home</a>
                    <a href="<?= SITE_URL ?>Home/faleConosco">Contact</a>
                </p>

                <ul class="icons p-0">
                    <li class="icons-item">
                        <a class="text-white" href="">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                    </li>

                    <li class="icons-item">
                        <a class="text-white" href="">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                    </li>

                    <li class="icons-item">
                        <a class="text-white" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-3 pb-3">
            <div class="col-md-12 text-center">
                <p class="info">
                    Copyright © <?= date("Y") ?> | By SpaceBurguer
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="<?= SITE_URL ?>assets/js/toasts.js"></script>
<script src="<?= SITE_URL ?>assets/js/informacoesPedido.js"></script>
<script src="<?= SITE_URL ?>assets/js/pagamento.js"></script>
<script src="<?= SITE_URL ?>assets/js/mascara.js"></script>
<script src="<?= SITE_URL ?>assets/DataTables/js/jquery.dataTables.min.js"></script>
<script src="<?= SITE_URL ?>assets/DataTables/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="<?= SITE_URL ?>assets/DataTables/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function() {
        fetch('<?= SITE_URL ?>assets/DataTables/pt_br.json')
            .then(mock => {
                return mock.json()
            })
            .then(data => {
                $('#tblLista').DataTable({
                    language: data
                });
            });
    });
</script>

<script>
    feather.replace()
</script>
</body>

</html>