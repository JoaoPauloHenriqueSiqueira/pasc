<?php

namespace App\Library;

class Format
{
    public static function formatCoin($value)
    {
        return "R$" . number_format($value, 2, ',', '.');
    }
}
