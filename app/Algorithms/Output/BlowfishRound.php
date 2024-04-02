<?php

namespace App\Algorithms\Output;

/**
 * This class represents data from one round of blowfish - look at schema to fully understand attributes
 */
class BlowfishRound
{
    /**
     * All attributes needs to be encoded to be in more 'human friendly' representation
     */
    public function __construct(
        private string $inputLeft,
        private string $inputRight,
        private string $leftBlockAfterXor,
        private string $rightBlockAfterXor,
        private string $rightBlockAfterFeistel,
        private string $subkey
    ) {
        $this->inputLeft = ($inputLeft);
        $this->inputRight = ($inputRight);
        $this->leftBlockAfterXor = ($leftBlockAfterXor);
        $this->rightBlockAfterXor = ($rightBlockAfterXor);
        $this->rightBlockAfterFeistel = ($rightBlockAfterFeistel);
        $this->subkey = ($subkey);
    }

    public function getInputLeft(): string
    {
        return $this->inputLeft;
    }

    public function getInputRight(): string
    {
        return $this->inputRight;
    }

    public function getLeftBlockAfterXor(): string
    {
        return $this->leftBlockAfterXor;
    }

    public function getRightBlockAfterXor(): string
    {
        return $this->rightBlockAfterXor;
    }

    public function getRightBlockAfterFeistel(): string
    {
        return $this->rightBlockAfterFeistel;
    }

    public function getSubkey(): string
    {
        return $this->subkey;
    }
}
