<?php

namespace App\Algorithms\Output\Steps;

class A5_1Step extends Step
{
    private string $majorityBit;

    private array $toBeClocked;

    private string $keyStreamBit;

    public function __construct(
        private readonly string $registerA,
        private readonly string $registerB,
        private readonly string $registerC,
        private ?string $registerAClocked = '',
        private ?string $registerBClocked = '',
        private ?string $registerCClocked = ''
    ) {
        parent::__construct();
    }

    public function getRegisterA(): string
    {
        return $this->registerA;
    }

    public function getRegisterB(): string
    {
        return $this->registerB;
    }

    public function getRegisterC(): string
    {
        return $this->registerC;
    }

    public function getRegisterAClocked(): ?string
    {
        return $this->registerAClocked;
    }

    public function getRegisterBClocked(): ?string
    {
        return $this->registerBClocked;
    }

    public function getRegisterCClocked(): ?string
    {
        return $this->registerCClocked;
    }

    public function getKeyStreamBit(): string
    {
        return $this->keyStreamBit;
    }

    public function setKeyStreamBit(string $keyStreamBit): void
    {
        $this->keyStreamBit = $keyStreamBit;
    }

    public function setClockedRegisters(string $a, string $b, string $c): void
    {
        $this->registerAClocked = $a;
        $this->registerBClocked = $b;
        $this->registerCClocked = $c;
    }

    public function getRegistersBeforeClock(): array
    {
        return ['R1' => $this->registerA, 'R2' => $this->registerB, 'R3' => $this->registerC];
    }

    public function getRegistersAfterClock(): array
    {
        return ['R1' => $this->registerAClocked, 'R2' => $this->registerBClocked, 'R3' => $this->registerCClocked];
    }

    public function getRegisterLastBits(): array
    {
        return [
            'R1lastBit' => $this->registerAClocked[18],
            'R2lastBit' => $this->registerBClocked[21],
            'R3lastBit' => $this->registerCClocked[22],
        ];
    }

    public function getMajorityBit(): string
    {
        return $this->majorityBit;
    }

    public function setMajorityBit(string $majorityBit): void
    {
        $this->majorityBit = $majorityBit;
    }

    public function getToBeClocked(): string
    {
        return implode(', ', array_filter($this->toBeClocked));
    }

    public function setToBeClocked(array $clockArray): void
    {
        $this->toBeClocked = $clockArray;
    }
}
