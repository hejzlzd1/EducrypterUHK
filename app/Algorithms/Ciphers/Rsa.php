<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\RsaOutput;
use App\Algorithms\Output\Steps\RSAStep;

class Rsa extends CipherBase
{
    public function __construct(string $text,private ?int $publicKey, private ?int $privateKey, int $operation, private ?int $p, private ?int $q)
    {
        // For this case we convert input string into ascii, each character splitted by ' '
        $text = $operation === CipherBase::ALGORITHM_ENCRYPT ? $this->getAsciiFromString($text) : $text;
        parent::__construct($text, null, $operation);
    }

    /**
     * @return BasicOutput
     */
    public function decrypt(): BasicOutput
    {
        $n = $this->publicKey;
        $result = '';
        $steps = [];
        $d = $this->privateKey;

        foreach (explode(' ', $this->text) as $char) {
            $c = gmp_pow(gmp_init($char), $d); // use first part of encryption key -> $e
            $cBeforeModulo = gmp_intval($c);
            $c = gmp_mod($c, $n); // use of second part of encryption key to generate encrypted char -> $n
            $result .= $c . ' ';
            $steps[] = new RSAStep(beforeModulo: $cBeforeModulo, inputChar: (int)$char, outputChar: gmp_intval($c));
        }

       // Return the resulting output object
        return new RsaOutput(
            inputValue: $this->text, operation: $this->operation,
            outputValue: $result,
            steps: $steps,
            n: $this->publicKey,
            d: $d
        );
    }

    /**
     * @return BasicOutput
     */
    public function encrypt(): BasicOutput
    {
        // Encryption key generation -> calculate n from prime numbers
        $n = $this->p * $this->q;

        // fermat number
        $e = 257;
        // declaring phi
        $phi = ($this->p - 1) * ($this->q - 1);
        // searching for co-prime number
        while ($e < $phi) {
            /*
             * e must be co-prime to phi and
             * smaller than phi.
             */
            if (gmp_intval(gmp_gcd($e, $phi)) === 1) {
                break;
            } else {
                $e++;
            }
        }
        $d = gmp_invert(gmp_init($e), gmp_init($phi));
        $d = gmp_strval($d);

        // Encryption process
        $result = '';
        $steps = [];
        foreach (explode(' ', $this->text) as $char) {
            $c = gmp_pow(gmp_init($char), $e); // use first part of encryption key -> $e
            $cBeforeModulo = gmp_intval($c);
            $c = gmp_mod($c, $n); // use of second part of encryption key to generate encrypted char -> $n
            $steps[] = new RSAStep(beforeModulo: $cBeforeModulo, inputChar: (int)$char, outputChar: gmp_intval($c));
            $result .= $c . ' ';
        }

        // Return the resulting output object
        return new RsaOutput(
            inputValue: $this->text, operation: $this->operation, outputValue: $result, steps: $steps,
            n: $n,
            e: $e,
            d: $d,
            phi: $phi,
        );
    }
}