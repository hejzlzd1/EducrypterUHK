<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\RSAStep;
use App\Algorithms\Output\Steps\Step;

/**
 * This class represents data from RSA
 */
class DiffieHellmanOutput extends BasicOutput
{
    /**
     * @param int $base
     * @param int $modulus
     * @param int|null $outputValue
     * @param array<Step>|null $steps
     * @param int $a
     * @param int $b
     */
    public function __construct(
        private int $base,
        private int $modulus,
        private int $a,
        private int $b,
        private ?int $outputValue = null,
        private ?array $steps = null,
    ) {
        //
    }

    public function getBase(): int
    {
        return $this->base;
    }

    public function getModulus(): int
    {
        return $this->modulus;
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getOutputValue(): ?string
    {
        return $this->outputValue;
    }

    public function getSteps(): ?array
    {
        return $this->steps;
    }
}
