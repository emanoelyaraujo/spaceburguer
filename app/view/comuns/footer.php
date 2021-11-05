
<script src="<?= SITE_URL ?>assets/js/Toasts.js"></script>
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