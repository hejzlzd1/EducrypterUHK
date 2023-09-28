<?php

namespace App\Algorithms\Output;

class BasicOutput
{
    private string $inputValue;
    private string $outputValue;
    private int $operation;
    private ?array $additionalInformation;
    private ?string $key;
    private ?array $steps;

    /**
     * @param string $inputValue
     * @param string $outputValue
     * @param int $operation
     * @param array|string $key
     * @param ?array<int,Step> $steps
     * @param ?array<int,string> $additionalInformation
     */
    public function __construct(
        string $inputValue,
        int $operation,
        array|string $key,
        ?string $outputValue = '',
        ?array $steps = null,
        ?array $additionalInformation = []
    ) {
        $this->inputValue = $inputValue;
        $this->outputValue = $outputValue;
        $this->operation = $operation;
        $this->key = $key;
        $this->steps = $steps;
        $this->additionalInformation = $additionalInformation;
    }

    /**
     * @return string
     */
    public function getInputValue(): string
    {
        return $this->inputValue;
    }

    /**
     * @param string $inputValue
     */
    public function setInputValue(string $inputValue): void
    {
        $this->inputValue = $inputValue;
    }

    /**
     * @return string
     */
    public function getOutputValue(): string
    {
        return $this->outputValue;
    }

    /**
     * @param string $outputValue
     */
    public function setOutputValue(string $outputValue): void
    {
        $this->outputValue = $outputValue;
    }

    /**
     * @return int
     */
    public function getOperation(): int
    {
        return $this->operation;
    }

    /**
     * @param int $operation
     */
    public function setOperation(int $operation): void
    {
        $this->operation = $operation;
    }

    /**
     * @return array|string
     */
    public function getKey(): array|string
    {
        return $this->key;
    }

    /**
     * @param array|string $key
     */
    public function setKey(array|string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function getSteps(): array
    {
        return $this->steps;
    }

    /**
     * @param array $steps
     */
    public function setSteps(array $steps): void
    {
        $this->steps = $steps;
    }

    /**
     * @return array
     */
    public function getAdditionalInformation(): array
    {
        return $this->additionalInformation;
    }

    /**
     * @param array $additionalInformation
     */
    public function setAdditionalInformation(array $additionalInformation): void
    {
        $this->additionalInformation = $additionalInformation;
    }

    public function addStep(Step $step): void
    {
        $this->steps[] = $step;
    }

    public function addAdditionalInformation(array $information): void
    {
        $this->additionalInformation = array_merge($this->additionalInformation, $information);
    }
}
