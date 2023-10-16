<?php

namespace App\Algorithms\Output\Steps;

class Step
{
    private string $input;
    private string $output;

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

    /**
     * @return string
     */
    public function getInputInBinary(): string
    {
        return $this->inputInBinary;
    }

    /**
     * @param string $inputInBinary
     */
    public function setInputInBinary(string $inputInBinary): void
    {
        $this->inputInBinary = $inputInBinary;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * @param string $output
     */
    public function setOutput(string $output): void
    {
        $this->output = $output;
    }

}
