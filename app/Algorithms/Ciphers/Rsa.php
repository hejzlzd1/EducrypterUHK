<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;

class Rsa extends CipherBase
{
    public function __construct(string $text, ?string $key, int $operation, private int $p, private int $q)
    {
        $this->text = $this->getAsciiFromString($text);
        $this->key = $key;
        $this->operation = $operation;
    }
    /**
     * @return BasicOutput
     */
    public function decrypt(): BasicOutput
    {
        $n = $this->p * $this->q;
        $e = 2;
        $phi = ($this->p - 1) * ($this->q - 1);
        while ($e < $phi) {
            /*
             * e must be co-prime to phi and
             * smaller than phi.
             */
            if (gmp_gcd($e, $phi) == 1)
                break;
            else
                $e++;
        }
        $k = 2; // A constant value
        $d = (1 + ($k * $phi)) / $e;
        $result = '';
        // Return the resulting string
        return new BasicOutput(
            inputValue: $this->text,
            operation: $this->operation,
            key: $this->key,
            outputValue: $result,
        );
    }

    /**
     * @return BasicOutput
     */
    public function encrypt(): BasicOutput
    {
        $n = $this->p * $this->q;
        $e = 2;
        $phi = ($this->p - 1) * ($this->q - 1);
        while ($e < $phi) {
            /*
             * e must be co-prime to phi and
             * smaller than phi.
             */
            if (gmp_gcd($e, $phi) == 1)
                break;
            else
                $e++;
        }

        $result = '';
        foreach (explode('|', $this->text) as $char) {
            $c = pow($char, $e);
            $c = $c % $n;
            $result .= $c;
        }

        // Return the resulting output object
        return new BasicOutput(
            inputValue: $this->text,
            operation: $this->operation,
            key: $this->key,
            outputValue: $result
        );
    }
}
