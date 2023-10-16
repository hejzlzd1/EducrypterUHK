<?php

namespace App\Algorithms\Output\Steps;

class A5_1Step extends Step
{
    private string $registerA;
    private string $registerB;
    private string $registerC;

    private string $majorityBit;
    private array $toBeClocked;

    private ?string $registerAClocked;
    private ?string $registerBClocked;
    private ?string $registerCClocked;

    private string $keyStreamBit;

    /**
     * @param string $registerA
     * @param string $registerB
     * @param string $registerC
     * @param string|null $registerAClocked
     * @param string|null $registerBClocked
     * @param string|null $registerCClocked
     */
    public function __construct(
        string $registerA,
        string $registerB,
        string $registerC,
        ?string $registerAClocked = '',
        ?string $registerBClocked = '',
        ?string $registerCClocked = ''
    ) {
        $this->registerA = $registerA;
        $this->registerB = $registerB;
        $this->registerC = $registerC;
        $this->registerAClocked = $registerAClocked;
        $this->registerBClocked = $registerBClocked;
        $this->registerCClocked = $registerCClocked;
        parent::__construct();
    }


    /**
     * @return string
     */
    public function getRegisterA(): string
    {
        return $this->registerA;
    }

    /**
     * @param string $registerA
     */
    public function setRegisterA(string $registerA): void
    {
        $this->registerA = $registerA;
    }

    /**
     * @return string
     */
    public function getRegisterB(): string
    {
        return $this->registerB;
    }

    /**
     * @param string $registerB
     */
    public function setRegisterB(string $registerB): void
    {
        $this->registerB = $registerB;
    }

    /**
     * @return string
     */
    public function getRegisterC(): array
    {
        return $this->registerC;
    }

    /**
     * @param string $registerC
     */
    public function setRegisterC(string $registerC): void
    {
        $this->registerC = $registerC;
    }

    /**
     * @return string
     */
    public function getRegisterAClocked(): string
    {
        return $this->registerAClocked;
    }

    /**
     * @param string $registerAClocked
     */
    public function setRegisterAClocked(string $registerAClocked): void
    {
        $this->registerAClocked = $registerAClocked;
    }

    /**
     * @return string
     */
    public function getRegisterBClocked(): string
    {
        return $this->registerBClocked;
    }

    /**
     * @param string $registerBClocked
     */
    public function setRegisterBClocked(string $registerBClocked): void
    {
        $this->registerBClocked = $registerBClocked;
    }

    /**
     * @return string
     */
    public function getRegisterCClocked(): string
    {
        return $this->registerCClocked;
    }

    /**
     * @param string $registerCClocked
     */
    public function setRegisterCClocked(string $registerCClocked): void
    {
        $this->registerCClocked = $registerCClocked;
    }

    /**
     * @return string
     */
    public function getKeyStreamBit(): string
    {
        return $this->keyStreamBit;
    }

    /**
     * @param string $keyStreamBit
     */
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
            'R3lastBit' => $this->registerCClocked[22]
        ];
    }

    /**
     * @return string
     */
    public function getMajorityBit(): string
    {
        return $this->majorityBit;
    }

    /**
     * @param string $majorityBit
     */
    public function setMajorityBit(string $majorityBit): void
    {
        $this->majorityBit = $majorityBit;
    }

    public function getToBeClocked(): string
    {
        return implode(', ',array_filter($this->toBeClocked));
    }

    public function setToBeClocked(array $clockArray): void
    {
        $this->toBeClocked = $clockArray;
    }
}