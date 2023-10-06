<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\Output\BasicOutput;
use App\Algorithms\StreamCipher;

class A5_1 extends StreamCipher
{
    //TODO: add step mechanism
    private string $keyStream = '';
    private BasicOutput $output;

    public function __construct(string $text, ?string $key, int $operation, string $iv)
    {
        $this->iv = $iv;
        parent::__construct($text, $key, $operation);
        $this->initializeRegisters(); // Initialize the A5/1 registers
        $this->output = new BasicOutput(inputValue: $text, operation: $operation, key: $key);
        $this->output->addAdditionalInformation(['iv' => $this->iv]);
    }

    public function encrypt(): BasicOutput|string
    {
        $keystream = $this->generateKeystream(strlen($this->text));
        $ciphertext = '';
        for ($i = 0; $i < strlen($this->text); $i++) {
            $ciphertext .= $this->text[$i] ^ $keystream[$i]; // Perform encryption
        }

        $this->output->setOutputValue($ciphertext);
        return $this->output; // Return the result of parent's encrypt method
    }

    public function decrypt(): BasicOutput|string
    {
        return $this->encrypt(); // A5/1 encryption and decryption are the same
    }

    public function generateKeystream($length)
    {
        for ($i = 0; $i < $length; $i++) {
            $this->clockAllRegisters(); // Clock all registers in A5/1
            $bit = $this->getOutputBit(); // Get the output bit
            $this->keyStream .= $bit; // Append the output bit to the keystream
        }
        return $this->keyStream; // Return the generated keystream
    }

    private function clockAllRegisters()
    {
        $this->registers['a'] = $this->clock($this->registers['a']);
        $this->registers['b'] = $this->clock($this->registers['b']);
        $this->registers['c'] = $this->clock($this->registers['c']);
    }

    private function getOutputBit()
    {
        // Calculate the majority bit using bitwise operations
        $maj = ($this->registers['a'][18] & $this->registers['b'][21]) ^
            ($this->registers['a'][22] & $this->registers['b'][23]) ^
            ($this->registers['a'][7] & $this->registers['b'][8]);

        return $maj; // Return the majority bit
    }

    private function clock($register)
    {
        // Perform clocking of a single register in A5/1
        $bit = ((int)$register[8] ^ (int)$register[10] ^ (int)$register[11] ^ (int)$register[12]) & 1;
        $register = $bit . $register;
        return $register; // Return the clocked register
    }
}
