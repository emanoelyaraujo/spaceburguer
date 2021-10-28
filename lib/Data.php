<?php 

class Data {

    public static function dmY($date, $type = 1)
    {
        return (!empty($date) ? date($type == 1 ? 'd/m/Y' : 'd/m/Y H:i:s', strtotime($date)) : '');
    }

    public static function dataSQL($date)
    {
        return date('Ymd', strtotime($date));
    }
}