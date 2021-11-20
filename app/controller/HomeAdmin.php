<?php

require_once 'app/model/ModelHomeAdmin.php';

Security::isAdmin();

$model = new HomeAdmin();

$post           = $_POST;

switch ($metodo)
{
    case "index": 
        require_once "app/view/homeAdmin.php";
}
