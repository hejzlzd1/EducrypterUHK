<?php

namespace App\Algorithms\Output\Steps;

class Step
{
    public function __construct(
        private string $input = '',
        private string $output = ''
    ) {
        //
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function setInput(string $input): void
    {
        $this->input = $input;
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function setOutput(string $output): void
    {
        $this->output = $output;
    }
}
