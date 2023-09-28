<?php

namespace App\Algorithms\Output;

/**
 * This class represents data from one round of blowfish - look at schema to fully understand attributes
 */
class BlowfishRound
{
    private string $inputLeft;
    private string $inputRight;
    private string $leftBlockAfterXor;
    private string $rightBlockAfterXor;
    private string $rightBlockAfterFeistel;
    private string $subkey;

    /**
     * All attributes needs to be encoded to be in more 'human friendly' representation
     * @param string $inputLeft
     * @param string $inputRight
     * @param string $leftBlockAfterXor
     * @param string $rightBlockAfterXor
     * @param string $rightBlockAfterFeistel
     * @param string $subkey
     */
    public function __construct(
        string $inputLeft,
        string $inputRight,
        string $leftBlockAfterXor,
        string $rightBlockAfterXor,
        string $rightBlockAfterFeistel,
        string $subkey
    ) {
        $this->inputLeft = base64_encode($inputLeft);
        $this->inputRight = base64_encode($inputRight);
        $this->leftBlockAfterXor = base64_encode($leftBlockAfterXor);
        $this->rightBlockAfterXor = base64_encode($rightBlockAfterXor);
        $this->rightBlockAfterFeistel = base64_encode($rightBlockAfterFeistel);
        $this->subkey = base64_encode($subkey);
    }

    /**
     * @return string
     */
    public function getInputLeft(): string
    {
        return $this->inputLeft;
    }

    /**
     * @param string $inputLeft
     */
    public function setInputLeft(string $inputLeft): void
    {
        $this->inputLeft = $inputLeft;
    }

    /**
     * @return string
     */
    public function getInputRight(): string
    {
        return $this->inputRight;
    }

    /**
     * @param string $inputRight
     */
    public function setInputRight(string $inputRight): void
    {
        $this->inputRight = $inputRight;
    }

    /**
     * @return string
     */
    public function getLeftBlockAfterXor(): string
    {
        return $this->leftBlockAfterXor;
    }

    /**
     * @param string $leftBlockAfterXor
     */
    public function setLeftBlockAfterXor(string $leftBlockAfterXor): void
    {
        $this->leftBlockAfterXor = $leftBlockAfterXor;
    }

    /**
     * @return string
     */
    public function getRightBlockAfterXor(): string
    {
        return $this->rightBlockAfterXor;
    }

    /**
     * @param string $rightBlockAfterXor
     */
    public function setRightBlockAfterXor(string $rightBlockAfterXor): void
    {
        $this->rightBlockAfterXor = $rightBlockAfterXor;
    }

    /**
     * @return string
     */
    public function getRightBlockAfterFeistel(): string
    {
        return $this->rightBlockAfterFeistel;
    }

    /**
     * @param string $rightBlockAfterFeistel
     */
    public function setRightBlockAfterFeistel(string $rightBlockAfterFeistel): void
    {
        $this->rightBlockAfterFeistel = $rightBlockAfterFeistel;
    }

    /**
     * @return string
     */
    public function getSubkey(): string
    {
        return $this->subkey;
    }

    /**
     * @param string $subkey
     */
    public function setSubkey(string $subkey): void
    {
        $this->subkey = $subkey;
    }


}
