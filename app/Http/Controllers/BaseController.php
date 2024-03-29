<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataValidationTrait;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    const TYPE_TEXT = 0;

    const TYPE_NUMBER = 1;
    const MAX_PRIME_NUMBER = 9999999999;

    const TYPE_NONZERO_NUMBER = 2;

    const VALIDATION_EMPTY = 'empty';

    const VALIDATION_NOT_BINARY = 'notBinary';

    const VALIDATION_NOT_PRIME_NUMBER = 'notPrimeNumber';

    const VALIDATION_CUSTOM_MESSAGE = 'customMessage';
    const VALIDATION_NOT_PRIMITIVE_ROOT = 'notPrimitiveRoot';

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
