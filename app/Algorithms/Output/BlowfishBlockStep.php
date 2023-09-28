<?php

namespace App\Algorithms\Output;

use JetBrains\PhpStorm\Pure;

/**
 * This class is created for each block in blowfish cipher -> contains array of BlowfishRoundSteps
 */
class BlowfishBlockStep extends Step
{
    /**
     * @var array<BlowfishRound>|null
     */
    private ?array $rounds;
    /**
     * @var string|null
     */
    private ?string $outputValue;

    /**
     * @param string|null $outputValue
     * @param array|null $rounds
     */
    #[Pure] public function __construct(string $outputValue = null, array $rounds = null,)
    {
        $this->rounds = $rounds;
        $this->outputValue = $outputValue;
        parent::__construct();
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
     * @return array
     */
    public function getRounds(): array
    {
        return $this->rounds;
    }

    /**
     * @param array $rounds
     */
    public function setRounds(array $rounds): void
    {
        $this->rounds = $rounds;
    }

}
