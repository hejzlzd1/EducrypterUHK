<?php

namespace App\Algorithms\Output;

use App\Algorithms\Output\Steps\RSAStep;
use App\Algorithms\Output\Steps\Step;

/**
 * This class represents data from RSA
 */
class DiffieHellmanOutput extends BasicOutput
{
    /**
     * @param int $base
     * @param int $modulus
     * @param int $a
     * @param int $b
     */
    public function __construct(
        private int $base,
        private int $modulus,
        private int $a,
        private int $b,
        private ?int $publicA = null,
        private ?int $publicB = null,
        private ?int $secretA = null,
        private ?int $secretB = null,
    ) {
        //
    }

    public function getBase(): int
    {
        return $this->base;
    }

    public function getModulus(): int
    {
        return $this->modulus;
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getPublicA(): ?int
    {
        return $this->publicA;
    }

    public function setPublicA(?int $publicA): void
    {
        $this->publicA = $publicA;
    }

    public function getPublicB(): ?int
    {
        return $this->publicB;
    }

    public function setPublicB(?int $publicB): void
    {
        $this->publicB = $publicB;
    }

    public function getSecretA(): ?int
    {
        return $this->secretA;
    }

    public function setSecretA(?int $secretA): void
    {
        $this->secretA = $secretA;
    }

    public function getSecretB(): ?int
    {
        return $this->secretB;
    }

    public function setSecretB(?int $secretB): void
    {
        $this->secretB = $secretB;
    }

}
