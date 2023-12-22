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

    public function getKeyStream(): ?int
    {
        return $this->keyStream;
    }

    public function getInputValue(): string
    {
        return $this->inputValue;
    }

    public function getOperation(): int
    {
        return $this->operation;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getOutputValue(): ?string
    {
        return $this->outputValue;
    }

    public function setOutputValue(string $outputValue): void
    {
        $this->outputValue = $outputValue;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function setSteps(array $steps): void
    {
        $this->steps = $steps;
    }

    public function getAdditionalInformation(): array
    {
        return $this->additionalInformation;
    }

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

    public function setKeyStream(?int $keyStream): void
    {
        $this->keyStream = $keyStream;
    }
}
