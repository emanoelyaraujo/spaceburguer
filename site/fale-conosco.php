<div class="container">

    <div class="row">
        <div class="col-md offset-md shadow-lg p-3 login">
            <h1>Fale Conosco</h1>
            <p>Dúvidas, sugestões, reclamações, mande sua mensagem, lhe retornaremos em breve!</p>
            <hr>
            <form class="row" action="#" method="post">

                <div class="form-group col-md-6">
                    <label for="input-group">Título</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" required>
                </div>

                <div class="form-group col-md-8 mt-3">
                    <label for="input-group">Assunto</label>
                    <textarea class="form-control" rows="15" cols="10" id="assunto" required>

                    </textarea>
                </div>

                <div class="col-md-12 offset-md-10 mt-3">
                    <a type="submit" href="#" class="btn btn-primary">Enviar</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= SITE_URL ?>/terceiros/ckeditor5/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector("#assunto"))
        .catch(error => {
            console.error( error );
        });
</script>