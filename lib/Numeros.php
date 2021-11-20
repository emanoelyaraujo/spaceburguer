<?php

class Numeros
{
    /**
     * formata o valor para o padrão brasileiro
     *
     * @param  float $valor
     * @return string
     */
    public static function formataValor($valor, $decimal = 2)
    {
        return number_format($valor, $decimal, ",", ".");
    }

    /**
     * formata o valor para salvar no banco
     *
     * @param  string $valor
     * @return float
     */
    public static function strValor($valor)
    {
        return str_replace(',', '.', str_replace('.', '', $valor));
    }
}
