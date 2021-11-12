<?php

class Security
{

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

    public static function pedidoAberto($pedido)
    {
        if(empty($pedido))
        {
            Redirect::page("Home/index");
            exit;
        }
    }
}
