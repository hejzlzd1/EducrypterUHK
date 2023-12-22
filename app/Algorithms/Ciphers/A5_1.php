<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\Steps\A5_1Step;
use App\Algorithms\StreamCipher;

class A5_1 extends StreamCipher
{
    private string $keyStream = '';

    private BasicOutput $output;

    /**
     * Registers for A5/1 cipher
     */
    protected array $R1 = [];

    protected array $R2 = [];

    protected array $R3 = [];

    /*
     * Theoretical info:
     * http://koclab.cs.ucsb.edu/teaching/cren/project/2017/jensen+andersen.pdf
     * This implementation is based on pdf above
     */
    public function __construct(string $text, ?string $key, int $operation, int $dataFrame)
    {
        parent::__construct($text, $key, $operation);
        $this->key = $this->expandOrTrimToSpecificBits(data: $this->key, size: 64);
        $dataFrameInteger = $dataFrame;
        $this->dataFrame = $this->expandOrTrimToSpecificBits(data: decbin($dataFrame), size: 22);

        $this->initializeRegisters(); // Initialize the A5/1 registers
        $this->output = new BasicOutput(inputValue: $text, operation: $operation, key: $key);
        $this->output->addAdditionalInformation(['dataFrameBinary' => $this->dataFrame, 'dataFrame' => $dataFrameInteger]);
    }

    public function encrypt(): BasicOutput|string
    {
        $keystream = $this->generateKeystream(strlen($this->text)); // Generate keystream to encrypt input by xoring bits with it
        $this->output->addAdditionalInformation(['keyStream' => $keystream]);
        $ciphertext = '';
        for ($i = 0; $i < strlen($this->text); $i++) {
            $step = $this->output->getStep($i); // get step
            $step->setInput($this->text[$i]); // set input bit

            $ciphertext .= ($this->text[$i] ^ (int) $keystream[$i]); // Perform encryption

            $step->setOutput($this->text[$i] ^ (int) $keystream[$i]); // set output after xor with text
        }

        $this->output->setOutputValue($ciphertext);

        return $this->output; // Return the result of parent's encrypt method
    }

    public function decrypt(): BasicOutput|string
    {
        return $this->encrypt(); // A5/1 encryption and decryption are the same
    }

    public function initializeRegisters()
    {
        $this->R1 = array_fill(0, 19, 0);
        $this->R2 = array_fill(0, 22, 0);
        $this->R3 = array_fill(0, 23, 0);

        for ($i = 0; $i < 64; $i++) {
            $this->clockAllRegisters(irregular: false);
            $keyBit = ($this->key[63 - $i]);
            $this->R1[0] ^= $keyBit;
            $this->R2[0] ^= $keyBit;
            $this->R3[0] ^= $keyBit;
        }

        for ($i = 0; $i < 22; $i++) {
            $this->clockAllRegisters(irregular: false);
            $frameBit = ($this->key[21 - $i]);
            $this->R1[0] ^= $frameBit;
            $this->R2[0] ^= $frameBit;
            $this->R3[0] ^= $frameBit;
        }

        for ($i = 0; $i < 100; $i++) {
            $this->clockAllRegisters();
        }
    }

    public function generateKeystream($length): string
    {
        for ($i = 0; $i < $length; $i++) {
            $step = new A5_1Step(
                registerA: implode('', $this->R1),
                registerB: implode('', $this->R2),
                registerC: implode('', $this->R3),
            );
            $majorityBit = $this->getMajorityBit($this->R1[8], $this->R2[10], $this->R3[10]);
            $step->setMajorityBit($majorityBit);
            $step->setToBeClocked([$this->R1[8] === $majorityBit ? 'R1' : '', $this->R2[10] === $majorityBit ? 'R2' : '', $this->R3[10] === $majorityBit ? 'R3' : '']);
            $this->clockAllRegisters(); // Clock all registers depending on majority bit

            $step->setClockedRegisters(
                a: implode('', $this->R1),
                b: implode('', $this->R2),
                c: implode('', $this->R3),
            );
            $bit = $this->getOutputBit(); // Get the output bit
            $step->setKeyStreamBit($bit);
            $this->keyStream .= $bit; // Append the output bit to the keystream
            $this->output->addStep($step);
        }

        return $this->keyStream; // Return the generated keystream
    }

    private function getMajorityBit($a, $b, $c)
    {
        $countOnes = $a + $b + $c;

        return ($countOnes >= 2) ? 1 : 0;
    }

    private function clockAllRegisters(bool $irregular = true): void
    {
        if ($irregular) {
            $majority = $this->getMajorityBit($this->R1[8], $this->R2[10], $this->R3[10]);

            if ($this->R1[8] == $majority) {
                $this->R1 = $this->clock($this->R1, [13, 16, 17, 18]);
            }

            if ($this->R2[10] == $majority) {
                $this->R2 = $this->clock($this->R2, [20, 21]);
            }

            if ($this->R3[10] == $majority) {
                $this->R3 = $this->clock($this->R3, [7, 20, 21, 22]);
            }
        } else {
            $this->R1 = $this->clock($this->R1, [13, 16, 17, 18]);
            $this->R2 = $this->clock($this->R2, [20, 21]);
            $this->R3 = $this->clock($this->R3, [7, 20, 21, 22]);
        }
    }

    private function clock(&$register, $taps): array
    {
        $feedback = 0;
        foreach ($taps as $tap) {
            $feedback ^= $register[$tap];
        }

        for ($i = count($register) - 1; $i > 0; $i--) {
            $register[$i] = $register[$i - 1];
        }

        $register[0] = $feedback;

        return $register;
    }

    private function getOutputBit(): string
    {
        return $this->R1[18] ^ $this->R2[21] ^ $this->R3[22];
    }
}
