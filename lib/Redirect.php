<?php

class Redirect
{
    /**
     * Redirecina a página para o endereço indicado em $caminho
     *
     * @param string $caminho 
     * @return void
     */
    public static function page($caminho)
    {
        ?>
        <script language="JavaScript">
            window.location = "<?= SITE_URL . $caminho ?>";
        </script>
        <?php
        exit;
    }
    
    /**
     * Pega o id do PIlls clicado para adicionar a classe active no botão e no form
     *
     * @param  string $id
     * @param  boolean $show
     * @return string
     */
    public static function getPills($id, $show = false)
    {
        return isset($_SESSION['pill']) ? ($_SESSION['pill'] == $id ? 'active' . ($show ? ' show' : '') : '') : '';
    }
}
