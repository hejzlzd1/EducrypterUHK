<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\NamedStep;

/**
 * This class represents data from SDES
 */
class SDESOutput extends BasicOutput
{
    /**
     * @var array<NamedStep> $keyGeneration
     */
    private array $keyGenerationSteps;

    public function __construct(
        string $inputValue,
        int    $operation,
        string $outputValue = null,
        array  $steps = [],
        ?int   $key = null,
    )
    {
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

    public function addKeyGenerationStep(NamedStep $step): void
    {
        $this->keyGenerationSteps[] = $step;
    }
}
