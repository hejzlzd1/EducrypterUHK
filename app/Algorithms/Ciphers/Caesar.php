<?php

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
        $result = '';
        $shift = 26 - $this->shift;

        // traverse text
        for ($i = 0; $i < strlen($this->text); $i++) {
            if ($this->text[$i] != ' ') {
                // apply transformation to each
                // character Encrypt Uppercase letters
                if (ctype_upper($this->text[$i])) {
                    $result = $result . chr(
                        (ord($this->text[$i]) +
                                $shift - 65) % 26 + 65
                    );
                } // Encrypt Lowercase letters
                else {
                    $result = $result . chr(
                        (ord($this->text[$i]) +
                                $shift - 97) % 26 + 97
                    );
                }
            } else {
                $result = $result . chr(32);
            }
        }

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
        $result = '';

        // traverse text
        for ($i = 0; $i < strlen($this->text); $i++) {
            if ($this->text[$i] != ' ') {
                // apply transformation to each
                // character Encrypt Uppercase letters
                if (ctype_upper($this->text[$i])) {
                    $result = $result . chr(
                        (ord($this->text[$i]) +
                                $this->shift - 65) % 26 + 65
                    );
                } // Encrypt Lowercase letters
                else {
                    $result = $result . chr(
                        (ord($this->text[$i]) +
                                $this->shift - 97) % 26 + 97
                    );
                }
            } else {
                $result = $result . chr(32);
            }
        }

        // Return the resulting output object
        return new BasicOutput(
            inputValue: $this->text,
            outputValue: $result,
            operation: $this->operation,
            key: $this->shift,
            additionalInformation: ['shiftedAlphabet' => $this->rotateAlphabet()]
        );
    }
}
