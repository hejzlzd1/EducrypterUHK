<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\NamedStep;

/**
 * This class represents data from SDES
 */
class TSDESOutput extends BasicOutput
{
    /**
     * @var array<SDESOutput> $desOutputs
     */
    private array $desOutputs;

    private string $key2;

    public function __construct(
        string $inputValue,
        int $operation,
        ?string $key,
        ?string $key2,
        ?string $outputValue = '',
        ?array $steps = null,
        ?array $additionalInformation = []
    ) {
        $this->key2 = $key2;
        parent::__construct($inputValue, $operation, $key, $outputValue, $steps, $additionalInformation);
    }

    public function getDesOutputs(): array
    {
        return $this->desOutputs;
    }

    public function getKey2(): string
    {
        return $this->key2;
    }

    public function addDesStep(SDESOutput $output): void
    {
        $this->desOutputs[] = $output;
    }
}
