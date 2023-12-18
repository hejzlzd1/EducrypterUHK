<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataValidationTrait;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    const TYPE_TEXT = 0,
        TYPE_NUMBER = 1,
        TYPE_NONZERO_NUMBER = 2;

    const VALIDATION_EMPTY = 'empty',
        VALIDATION_NOT_BINARY = 'notBinary',
        VALIDATION_NOT_PRIME_NUMBER = 'notPrimeNumber',
        VALIDATION_CUSTOM_MESSAGE = 'customMessage';
    use DataValidationTrait;

    protected function hextobin($hexstr): string
    {
        $n = strlen($hexstr);
        $sbin = '';
        $i = 0;
        while ($i < $n) {
            $a = substr($hexstr, $i, 2);
            $c = pack('H*', $a);
            if ($i == 0) {
                $sbin = $c;
            } else {
                $sbin .= $c;
            }
            $i += 2;
        }
        return $sbin;
    }
}