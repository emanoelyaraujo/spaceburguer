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
            window.location="<?= SITE_URL . $caminho ?>";
        </script>
        <?php
    }
}
