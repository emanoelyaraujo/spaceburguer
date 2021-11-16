<?php

class Data
{
    
    /**
     * formata a data para o formato d/m/Y
     *
     * @param  mixed $date
     * @param  mixed $type
     * @return string
     */
    public static function dmY($date, $type = 1)
    {
        return (!empty($date) ? date($type == 1 ? 'd/m/Y' : 'd/m/Y H:i:s', strtotime($date)) : '');
    }
    
    /**
     * retorna data e hora atual
     *
     * @return string
     */
    public static function dataHoraAtual()
    {
        date_default_timezone_set("America/Sao_Paulo");

        return date('Y-m-d H:i:s', time());
    }
}
