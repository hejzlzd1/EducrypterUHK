<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\NamedStep;

/**
 * This class represents data from SDES
 */
class SAESOutput extends BasicOutput
{
    /**
     * @var array<NamedStep> $keyGeneration
     */
    private array $keyGenerationSteps;

    private array $roundKeys = [];

    public function __construct(
        string $inputValue,
        int $operation,
        string $outputValue = null,
        array $steps = [],
        ?string $key = null,
    ) {
        parent::__construct(
            inputValue: $inputValue,
            operation: $operation,
            key: $key,
            outputValue: $outputValue,
            steps: $steps,
            additionalInformation: null
        );
    }

    /**
     * @return NamedStep[]
     */
    public function getKeyGenerationSteps(): array
    {
        return $this->keyGenerationSteps;
    }

    /**
     * @param array<NamedStep> $keyGenerationSteps
     */
    public function setGenerationSteps(array $keyGenerationSteps): void
    {
        $this->keyGenerationSteps = $keyGenerationSteps;
    }

    public function addKeyGenerationStep(NamedStep $step): void
    {
        $this->keyGenerationSteps[] = $step;
    }

    public function setRoundKeys(array $roundKeys): void
    {
        $this->roundKeys = $roundKeys;
    }
    public function getRoundKeys(): array
    {
        return $this->roundKeys;
    }
}
