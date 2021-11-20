<?php

class Formulario
{

    public static function titulo($titulo, $parametro = [])
    {
        // Seta sub titulo
        if (isset($parametro['acao']))
        {
            if ($parametro['acao'] == "insert")
            {
                $titulo .= " - Novo";
            }
            else if ($parametro['acao'] == "update")
            {
                $titulo .= " - Alteração";
            }
            else if ($parametro['acao'] == "delete")
            {
                $titulo .= " - Exclusão";
            }
            else if ($parametro['acao'] == "view")
            {
                $titulo .= " - Visualização";
            }
        }

        $textoBtnNovo = "";

        if (!isset($parametro['btNovo']))
        {
            $textoBtnNovo = '
                <a href="' . SITE_URL . '/' . $parametro['controller'] . '/form/insert" class="btn btn-secondary btn-sm btn-icons-crud mt-1" title="Novo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </a>
            ';
        }

        $texto = Formulario::exibeMsgError() . Formulario::exibeMsgSucesso();

        $texto .= '
            <section>
                <div class="container">
                    <div class="blog-banner">
                        <div class="row">
                            <div class="col-10 mt-3 mb-3 text-left">
                                <h1 style="color: #433A8F;">' . $titulo . '</h1>
                            </div>
                            <div class="col-2 mt-3 mb-3 text-right">
                                ' . $textoBtnNovo . '
                                <a href="' . SITE_URL . '/' . $parametro['controller'] . '/lista" class="btn btn-secondary btn-sm btn-icons-crud mt-1" title="Lista">                                            
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                        <line x1="8" y1="6" x2="21" y2="6"></line>
                                        <line x1="8" y1="12" x2="21" y2="12"></line>
                                        <line x1="8" y1="18" x2="21" y2="18"></line>
                                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';

        return $texto;
    }

    /**
     * exibeMsgError
     *
     * @return string
     */
    public static function exibeMsgError()
    {
        $texto = "";

        if (isset($_SESSION['msgError']))
        {

            $texto .= '
            <div class="position-relative" style="z-index:1100;">
                <div class="position-absolute top-0 end-0 p-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading">' . $_SESSION["msgError"] . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>';

            unset($_SESSION['msgError']);
        }

        return $texto;
    }


    /**
     * exibeMsgSucesso
     *
     * @return string
     */
    public static function exibeMsgSucesso()
    {
        $texto = "";

        if (isset($_SESSION['msgSucesso']))
        {
            $texto .= '
                <div class="position-relative" style="z-index:1100;">
                    <div class="position-absolute top-0 end-0 p-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">' . $_SESSION["msgSucesso"] . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>';
            unset($_SESSION["msgSucesso"]);
        }

        return $texto;
    }

    public static function FormEmailCodigo($titulo, $subtitulo, $dados, $email = '', $view = "")
    {
        $html = Formulario::exibeMsgError() .
            '<div class="container vh-100">
                <form method="post" action="' . SITE_URL . $dados["action"] . '" class="row justify-content-center align-items-center h-100">
                    <div class="col-md-4 p-5" style="background-color: #fff;">
                        <div class="text-center mt-2">
                                <img src="' . SITE_URL . 'assets/img/space-icon.PNG" width="100px" alt="">
                                <h5 style="color: #433A8F;" class="mb-0 fw-bold">' . $titulo . '</h5>
                                <p class="pt-2 pb-2">' . $subtitulo . '</p>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="' . $dados["type"] . '" name="' . $dados["name"] . '" id="' . $dados["name"] . '" maxlength=' . $dados["maxlength"] . '" autofocus required>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <button type="submit" class="btn btnRoxo">ENTRAR</button>
                        </div>
                        </div>
                    </div>' .
                    (!empty($email) ? '<input type="hidden" name="email" value=' . $email . '>' : '') .
                    (!empty($view) ? '<input type="hidden" name="view" value=' . $view . '>' : '')
              .'</form>
            </div>';

        return $html;
    }
}
