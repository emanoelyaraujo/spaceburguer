<?php

class Security
{

    public static function isAdmin()
    {
        var_dump($_SESSION);
        if (isset($_SESSION["userNivel"]))
        {
            if ($_SESSION["userNivel"] != 1)
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
