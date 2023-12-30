<?php

namespace App\Algorithms\Output\Steps;

use App\Algorithms\Output\BlowfishRound;
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

    private ?string $outputValue;

    #[Pure]
    public function __construct(?string $outputValue = null, ?array $rounds = null)
    {
        $this->rounds = $rounds;
        $this->outputValue = $outputValue;
        parent::__construct();
    }

    public function getOutputValue(): string
    {
        return $this->outputValue;
    }

    public function setOutputValue(string $outputValue): void
    {
        $this->outputValue = $outputValue;
    }

    public function getRounds(): array
    {
        return $this->rounds;
    }

    public function setRounds(array $rounds): void
    {
        $this->rounds = $rounds;
    }
}
