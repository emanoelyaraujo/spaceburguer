<div class="content">
    <div class="container">
        <?= Formulario::exibeMsgSucesso() . Formulario::exibeMsgError() ?>
        <div class="row justify-content-center">
            <div class="col-md-10 p-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="heading mb-4">Fale Conosco</h1>
                        <p>Dúvidas, sugestões, reclamações, mande sua mensagem, iremos retornar em breve!</p>
                        <p><img src="<?= SITE_URL ?>assets/img/SVG/Astronauta.svg" alt="Image" class="img-fluid"></p>
                    </div>
                    <div class="col-md-6 mt-2">
                        <form action="<?= SITE_URL ?>Home/envioEmail" method="post" id="contactForm" name="contactForm">
                            <div class="row mb-3">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Seu nome" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Seu e-mail" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="assunto" id="assunto" placeholder="Assunto" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="mensagem" id="mensagem" 
                                        placeholder="Descreva de forma detalhada o motivo do seu contato" 
                                        style="margin-top: 0px; margin-bottom: 0px; height: 162px;">
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btnRoxo rounded-0" type="submit">Enviar Mensagem</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector("#mensagem"))
        .catch(error => {
            console.error(error);
        });
</script>