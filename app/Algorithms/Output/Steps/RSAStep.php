<?php

namespace App\Algorithms\Output\Steps;

class RSAStep extends Step
{
    public function __construct(private float $beforeModulo, private int $inputChar, private int $outputChar)
    {
        parent::__construct();
    }

    public function getBeforeModulo(): int
    {
        return $this->beforeModulo;
    }

    public function getInputChar(): int
    {
        return $this->inputChar;
    }

    public function getOutputChar(): int
    {
        return $this->outputChar;
    }
}
