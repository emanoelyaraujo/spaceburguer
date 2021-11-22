<?php

class Helpers
{
    // busca o status de acordo com a ação passada
    public static $status = [
        "F" => "Pedido Finalizado",
        "C" => "Pedido a Caminho",
        "E" => "Entregue",
        "1" => "<div class='text-center'><span class='badge bg-success'>Ativo</span></div>",
        "2" => "<div class='text-center'><span class='badge bg-warning'>Inativo</span></div>"
    ];

    public static $nivel = [
        "1" => "Administrador",
        "2" => "Usuário",
        "3" => "Motoboy"
    ];

    // busca o texto e a cor dos botões de acordo com a ação passada 
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

    // busca as ações do input de acordo com a ação passada
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

    public static $homeNivel = [
        '1' => 'HomeAdmin/index',
        '2' => '',
        '3' => 'HomeMotoboy/index'
    ];
}
