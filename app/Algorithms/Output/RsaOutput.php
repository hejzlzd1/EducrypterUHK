<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\RSAStep;

/**
 * This class represents data from RSA
 */
class RsaOutput extends BasicOutput
{
    /**
     * @param ?int $n => first part of public key (n = p * q)
     * @param ?int $e => second part of public key (co-prime number)
     * @param ?int $d => private key d = (k*Φ(n) + 1) / e
     * @param ?float $phi => Φ(n) = (P-1)(Q-1)
     * @param string $inputValue
     * @param int $operation
     * @param string $outputValue
     * @param array<RSAStep> $steps
     */
    public function __construct(
        string $inputValue,
        int $operation,
        string $outputValue,
        array $steps,
        private ?int $n = null,
        private ?int $e = null,
        private ?int $d = null,
        private ?float $phi = null,
        ?int $key = null,
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
     * @return ?int
     */
    public function getN(): ?int
    {
        return $this->n;
    }

    /**
     * @return ?int
     */
    public function getE(): ?int
    {
        return $this->e;
    }

    /**
     * @return ?int
     */
    public function getD(): ?int
    {
        return $this->d;
    }

    /**
     * @return ?float
     */
    public function getPhi(): ?float
    {
        return $this->phi;
    }

}
