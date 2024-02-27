<?php

declare(strict_types=1);

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;

class Caesar extends CipherBase
{
    private int $shift;

    /**
     * Normalize input string to basic chars and set shifts
     */
    public function __construct(string $inputValue, int $shift, int $operation)
    {
        $this->shift = $shift;
        parent::__construct($this->normalize($inputValue), null, $operation);
    }

    /**
     * Get rotated alphabet
     */
    public function rotateAlphabet(): array
    {
        $alphabet = [];
        foreach (range('A', 'Z') as $char) {
            $alphabet[] = $char;
        }
        for ($i = 0; $i < $this->shift; $i++) {
            $temp = array_shift($alphabet);
            $alphabet[] = $temp;
        }

        return $alphabet;
    }

    /**
     * Show all 26 results of decryption, try moving alphabet 26 times
     */
    public function bruteForce(): array
    {
        $bruteForceResults = [];
        for ($i = 0; $i < 26; $i++) {
            $this->shift = $i;
            $bruteForceResults[] = $this->decrypt();
        }

        return $bruteForceResults;
    }

    public function decrypt(): BasicOutput
    {
        $shift = 26 - $this->shift;
        // traverse text
        $result = $this->shiftInput($shift);

        // Return the resulting string
        return new BasicOutput(
            inputValue: $this->text,
            outputValue: $result,
            operation: $this->operation,
            key: $this->shift,
            additionalInformation: ['shiftedAlphabet' => $this->rotateAlphabet()]
        );
    }

    public function encrypt(): BasicOutput
    {
        $result = $this->shiftInput($this->shift);
        // Return the resulting output object
        return new BasicOutput(
            inputValue: $this->text,
            outputValue: $result,
            operation: $this->operation,
            key: $this->shift,
            additionalInformation: ['shiftedAlphabet' => $this->rotateAlphabet()]
        );
    }

    public function shiftInput(int $shift): string
    {
        $result = '';
        for ($i = 0; $i < strlen($this->text); $i++) {
            if ($this->text[$i] !== ' ') {
                // $firstChar represents first char in ASCII (65 = A, 97 = a), mod 26 ensures that new char stays in boundaries
                $firstChar = ctype_upper($this->text[$i]) ? 65 : 97;
                $result = $result . chr((ord($this->text[$i]) + $shift - $firstChar) % 26 + $firstChar);
            } else {
                $result = $result . chr(32);
            }
        }
        return $result;
    }
}
