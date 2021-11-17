<?php

class Helpers
{
    public static $status = [
        "F" => "Pedido Finalizado",
        "C" => "Pedido a Caminho",
        "E" => "Entregue",
        "1" => "<div class='text-center'><span class='badge bg-success'>Ativo</span></div>",
        "2" => "<div class='text-center'><span class='badge bg-warning'>Inativo</span></div>"
    ];


    public static $botoes = [
        "update" => [
            "textoBotao" => "Gravar",
            "corBotao" => "primary"

        ],
        "insert" => [
            "textoBotao" => "Gravar",
            "corBotao" => "primary"

        ],
        "delete" => [
            "textoBotao" => "Excluir",
            "corBotao" => "danger"
        ]
    ];

    public static $acoesInput = [
        "delete" => [
            "readonly" => "readonly",
            "disabled" => "disabled"
        ],
        "view" => [
            "readonly" => "readonly",
            "disabled" => "disabled"
        ],
        "insert" => [
            "readonly" => "",
            "disabled" => ""
        ],
        "update" => [
            "readonly" => "",
            "disabled" => ""
        ],
    ];
}
