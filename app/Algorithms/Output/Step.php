<?php

namespace App\Algorithms\Output;

class Step
{
    protected string $input;
    public function __construct(string $input = ''){
        $this->input = $input;
    }

    /**
     * @return string
     */
    public function getInput(): string
    {
        return $this->input;
    }

    /**
     * @param string $input
     */
    public function setInput(string $input): void
    {
        $this->input = $input;
    }

}
