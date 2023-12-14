<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\Step;

class BasicOutput
{
    private ?int $keyStream;
    public function __construct(
        private readonly string $inputValue,
        private readonly int $operation,
        private ?string $key,
        private ?string $outputValue = '',
        private ?array $steps = null,
        private ?array $additionalInformation = []
    ) {
        //
    }

    /**
     * @return int|null
     */
    public function getKeyStream(): ?int
    {
        return $this->keyStream;
    }

    /**
     * @return string
     */
    public function getInputValue(): string
    {
        return $this->inputValue;
    }

    /**
     * @return int
     */
    public function getOperation(): int
    {
        return $this->operation;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @return string|null
     */
    public function getOutputValue(): ?string
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
     * @param string $key
     */
    public function setKey(string $key): void
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

    public function getStep(int $i): Step
    {
        return $this->steps[$i];
    }

    /**
     * @param int|null $keyStream
     */
    public function setKeyStream(?int $keyStream): void
    {
        $this->keyStream = $keyStream;
    }

}
