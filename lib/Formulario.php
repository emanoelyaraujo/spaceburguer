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
                <a href="' . SITE_URL . '/' . $parametro['controller'] . '/form/insert" class="btn btn-secondary btn-sm btn-icons-crud" title="Novo">
                    <i class="fa fa-plus" area-hidden="true"></i>
                </a>
            ';
        }

        $texto = '
                    <section>
                        <div class="container">
                            <div class="blog-banner">
                                <div class="row">
                                    <div class="col-10 mt-5 mb-5 text-left">
                                        <h1 style="color: #384aeb;">' . $titulo . '</h1>
                                    </div>
                                    <div class="col-2 mt-5 mb-5 text-right">
                                        ' . $textoBtnNovo . '
                                        <a href="' . SITE_URL . '/' . $parametro['controller'] . '/lista" class="btn btn-secondary btn-sm btn-icons-crud" title="Lista">
                                            <i class="fa fa-list" area-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>';

        $texto .= Formulario::exibeMsgError() . Formulario::exibeMsgSucesso();

        $texto .= '
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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>' . $_SESSION['msgError'] . '</strong>
                <div class="col-1">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>' . $_SESSION['msgSucesso'] . '</strong>
                    <div class="col-1">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
            unset($_SESSION["msgSucesso"]);
        }

        return $texto;
    }
}
