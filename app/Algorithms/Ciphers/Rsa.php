<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\RsaOutput;
use App\Algorithms\Output\Steps\RSAStep;

class Rsa extends CipherBase
{
    public function __construct(string $text, ?int $key, int $operation, private int $p, private int $q)
    {
        // For this case we convert input string into ascii, each character splitted by '|'
        $text = $operation === CipherBase::ALGORITHM_ENCRYPT ? $this->getAsciiFromString($text) : $text;
        parent::__construct($text, $key, $operation);
    }

    /**
     * @return BasicOutput
     */
    public function decrypt(): BasicOutput
    {
        $n = $this->p * $this->q;
        $result = '';
        $c = 1;
        $steps = [];
        $d = $this->key;

        foreach (explode('|', $this->text) as $char) {
            $c *= $char;
            $cBeforeModulo = $c;
            $c %= $n;
            $result .= $c . ' ';
            $steps[] = new RSAStep(beforeModulo: $cBeforeModulo, inputChar: (int)$char, outputChar: $c);

            $d--;
        }


       // Return the resulting output object
        return new RsaOutput(
            inputValue: $this->text, operation: $this->operation,
            outputValue: $result,
            steps: $steps,
            d: $d,
            phi: null,
        );
    }

    /**
     * @return BasicOutput
     */
    public function encrypt(): BasicOutput
    {
        // Encryption key generation -> calculate n from prime numbers
        $n = $this->p * $this->q;
        $e = 2;
        // declaring phi
        $phi = ($this->p - 1) * ($this->q - 1);
        // searching for co-prime number
        while ($e < $phi) {
            /*
             * e must be co-prime to phi and
             * smaller than phi.
             */
            if (gmp_gcd($e, $phi) == 1) {
                break;
            } else {
                $e++;
            }
        }

        // Encryption process
        $result = '';
        $steps = [];
        foreach (explode(' ', $this->text) as $char) {
            $c = pow((int)$char, $e); // use first part of encryption key -> $e
            $cBeforeModulo = $c;
            $c = $c % $n; // use of second part of encryption key to generate encrypted char -> $n
            $steps[] = new RSAStep(beforeModulo: $cBeforeModulo, inputChar: (int)$char, outputChar: $c);
            $result .= $c . ' ';
        }

        // Return the resulting output object
        return new RsaOutput(
            inputValue: $this->text, operation: $this->operation, outputValue: $result, steps: $steps,
            n: $n,
            e: $e,
            d: null,
            phi: $phi,
        );
    }
}
