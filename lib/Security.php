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

    public static function isUsuario()
    {
        if (isset($_SESSION["userNivel"]))
        {
            if ($_SESSION["userNivel"] != 2)
            {
                Redirect::page("login");
                exit;
            }
        }
        else
        {
            Redirect::page("login");
            exit;
        }
    }
}
