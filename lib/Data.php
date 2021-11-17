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
    
    /**
     * diferencaData
     *
     * @param  string $data_inicio
     * @param  string $data_fim
     * @return int
     */
    public static function diferencaData($data_inicio, $data_fim = '')
    {
        $data_inicio = new DateTime($data_inicio);
        $data_fim = new DateTime(empty($data_fim) ? date("Y-m-d H:i:s") : $data_fim);
        
        // Resgata diferença entre as datas
        $dateInterval = $data_inicio->diff($data_fim);

        return $dateInterval->days;
    }
}
