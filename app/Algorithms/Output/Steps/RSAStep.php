<?php

namespace App\Algorithms\Output\Steps;

class RSAStep extends Step
{
    public function __construct(private int $beforeModulo, private int $inputChar, private int $outputChar)
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getBeforeModulo(): int
    {
        return $this->beforeModulo;
    }

    /**
     * @return int
     */
    public function getInputChar(): int
    {
        return $this->inputChar;
    }

    /**
     * @return int
     */
    public function getOutputChar(): int
    {
        return $this->outputChar;
    }


}
