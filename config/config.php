<?php

    // endereço (url), base de nossa aplicação web

    //define("SITE_URL","http://netto-blog/");
    define("SITE_URL", "http://{$_SERVER['HTTP_HOST']}/");

    // Defie constantes com configurações de conexão com a base de dados

    define("DB_TYPE"    , 'mysql');
    define('DB_HOST'    , 'localhost');
    define('DB_PORT'    , '3306');
    define('DB_USER'    , 'root');
    define('DB_PASSWORD', '');
    define("DB_BDADOS"  , 'spaceburguer');