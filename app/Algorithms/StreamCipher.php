<?php

namespace App\Algorithms;

class StreamCipher extends CipherBase
{
    protected string $iv;
    protected array $registers = array();

    public function initializeRegisters()
    {
        $this->registers['a'] = $this->convertTextToBinary($this->key);
        $this->registers['b'] = $this->convertTextToBinary($this->iv);
        $this->registers['c'] = str_repeat('0', 64);
    }

    /**
     * @return string
     */
    public function getIv(): string
    {
        return $this->iv;
    }

    /**
     * @param string $iv
     */
    public function setIv(string $iv): void
    {
        $this->iv = $iv;
    }

    /**
     * @return array
     */
    public function getRegisters(): array
    {
        return $this->registers;
    }

    /**
     * @param array $registers
     */
    public function setRegisters(array $registers): void
    {
        $this->registers = $registers;
    }

}