<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\DiffieHellmanOutput;
use Exception;

class DiffieHellman extends CipherBase
{
    public function __construct(private int $modulus, private int $base, private int $a, private int $b)
    {
        //
    }

    public function generateSecret(): DiffieHellmanOutput
    {
        $output = new DiffieHellmanOutput(base: $this->base, modulus: $this->modulus, a: $this->a, b: $this->b);
        $publicA = gmp_mod(gmp_pow(gmp_init($this->base), $this->a), $this->modulus);
        $publicB = gmp_mod(gmp_pow($this->base, $this->b), $this->modulus);

        $sA = gmp_mod(gmp_pow($publicB, $this->a), $this->modulus);
        $sB = gmp_mod(gmp_pow($publicA, $this->b), $this->modulus);

        if (gmp_cmp($sA, $sB) !== 0) {
            throw new Exception(sprintf('Secret generation error, values don\'t match (sA = %s, sB = %s).', gmp_strval($sA), gmp_strval($sB)));
        }

        $output->setOutputValue(gmp_strval($sA));
        return $output;
    }
}