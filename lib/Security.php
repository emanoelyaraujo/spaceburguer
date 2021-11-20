<?php

class Security
{    
    /**
     * verifica se o usuário é adm
     *
     * @return void
     */
    public static function isAdmin()
    {
        if (isset($_SESSION["userNivel"]))
        {
            if ($_SESSION["userNivel"] != 1)
            {
                Redirect::page("Login/index");
                exit;
            }
        }
        else
        {
            Redirect::page("Login/index");
            exit;
        }
    }
    
    /**
     * verifica se é um usuário normal
     *
     * @return void
     */
    public static function isAUser2()
    {
        if (isset($_SESSION["userNivel"]))
        {
            if ($_SESSION["userNivel"] != 2)
            {
                Redirect::page("Home/index");
                exit;
            }
        }
        else
        {
            Redirect::page("Home/index");
            exit;
        }
    }
    
    /**
     * verifica se esta logado
     *
     * @return void
     */
    public static function isLogado()
    {
        if (isset($_SESSION["userNivel"]))
        {
            if ($_SESSION["userNivel"] != 1 && $_SESSION["userNivel"] != 2)
            {
                Redirect::page("Login/index");
                exit;
            }
        }
        else
        {
            Redirect::page("Login/index");
            exit;
        }
    }
    
    /**
     * verifica se há pedido aberto do usuario
     *
     * @param  mixed $pedido
     * @return void
     */
    public static function pedidoAberto($pedido)
    {
        if(empty($pedido))
        {
            Redirect::page("Home/index");
            exit;
        }
    }
}
