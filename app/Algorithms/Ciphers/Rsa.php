<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\RsaOutput;
use App\Algorithms\Output\Steps\RSAStep;

class Rsa extends CipherBase
{
    public function __construct(
        string $text,
        private readonly ?int $publicKey,
        private readonly ?int $privateKey,
        int $operation,
        private readonly ?int $p,
        private readonly ?int $q
    ) {
        // For this case we convert input string into ascii, each character separated by ' '
        $text = $operation === CipherBase::ALGORITHM_ENCRYPT ? $this->getAsciiFromString($text) : $text;
        parent::__construct($text, null, $operation);
    }

    public function decrypt(): BasicOutput
    {
        $n = $this->publicKey;
        $result = '';
        $steps = [];
        $d = $this->privateKey;

        foreach (explode(' ', $this->text) as $char) {
            $c = gmp_powm(gmp_init($char), $d, $n); // uses binary exponentiation (CORM09)
            $result .= chr(intval($c));
            $steps[] = new RSAStep(inputChar: (int)$char, outputChar: gmp_intval($c));
        }

        // Return the resulting output object
        return new RsaOutput(
            inputValue: $this->text,
            operation: $this->operation,
            outputValue: $result,
            steps: $steps,
            n: $this->publicKey,
            d: $d
        );
    }

    public function encrypt(): BasicOutput
    {
        $p = gmp_init($this->p);
        $q = gmp_init($this->q);

        // Encryption key generation -> calculate n from prime numbers
        $n = gmp_mul($p, $q);

        // Largest known prime number of the form 2^(2^n) + 1 (n =4)
        // Used for security reasons
        $e = 65537;
        // declaring phi
        $phi = gmp_mul(gmp_sub($p, 1), gmp_sub($q, 1));
        // searching for co-prime number
        while ($e < gmp_intval($phi)) {
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
        $d = gmp_invert(gmp_init($e), $phi);
        $d = gmp_intval($d);

        // Encryption process
        $result = '';
        $steps = [];
        foreach (explode(' ', $this->text) as $char) {
            $c = gmp_powm(gmp_init($char), $e, $n); // uses binary exponentiation (CORM09)
            $steps[] = new RSAStep(inputChar: (int)$char, outputChar: gmp_intval($c));
            $result .= $c . ' ';
        }

        // Return the resulting output object
        return new RsaOutput(
            inputValue: $this->text,
            operation: $this->operation,
            outputValue: $result,
            steps: $steps,
            n: gmp_intval($n),
            e: $e,
            d: $d,
            phi: gmp_intval($phi),
        );
    }
}
