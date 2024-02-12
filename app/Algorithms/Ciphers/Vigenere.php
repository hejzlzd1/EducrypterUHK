<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;

use function ctype_alpha;
use function ctype_upper;

class Vigenere extends CipherBase
{
    /**
     * Normalize input string to basic chars
     */
    public function __construct(string $text, string $key, int $operation)
    {
        parent::__construct($this->normalize($text), $this->resizeKey($key, strlen($text)), $operation);
    }

    /**
     * Modulo function
     */
    public static function Mod($a, $b): int
    {
        return ($a % $b + $b) % $b;
    }

    public function encrypt(): BasicOutput|string
    {
        $keyLen = strlen($this->key); //length of key

        for ($i = 0; $i < $keyLen; $i++) {
            if (!ctype_alpha($this->key[$i])) {
                return '';
            }
        } // found non char in key

        $output = '';
        $nonAlphaCharCount = 0;
        $inputLen = strlen($this->text); //length of input

        for ($i = 0; $i < $inputLen; $i++) {
            if (ctype_alpha($this->text[$i])) { //is char at index?
                $cIsUpper = ctype_upper($this->text[$i]); //is upper char?
                $offset = ord($cIsUpper ? 'A' : 'a'); // convert to ascii
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen; // get key index depending on key
                $k = ord(
                    $cIsUpper ? strtoupper($this->key[$keyIndex]) : strtolower($this->key[$keyIndex])
                ) - $offset; //get char
                $ch = chr(($this->mod(((ord($this->text[$i]) + $k) - $offset), 26)) + $offset); //get new char
                $output .= $ch;
            } else {
                $output .= $this->text[$i];
                $nonAlphaCharCount++;
            }
        }

        return new BasicOutput(
            inputValue: $this->text,
            operation: $this->operation,
            key: $this->key,
            outputValue: $output
        );
    }

    public function decrypt(): BasicOutput|string
    {
        $keyLen = strlen($this->key); //length of key

        for ($i = 0; $i < $keyLen; $i++) {
            if (!ctype_alpha($this->key[$i])) {
                return '';
            }
        } // found non char in key

        $output = '';
        $nonAlphaCharCount = 0;
        $inputLen = strlen($this->text); //length of input

        for ($i = 0; $i < $inputLen; $i++) {
            if (ctype_alpha($this->text[$i])) { //is char at index?
                $cIsUpper = ctype_upper($this->text[$i]); //is upper char?
                $offset = ord($cIsUpper ? 'A' : 'a'); // convert to ascii
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen; // get key index depending on key
                $k = ord(
                    $cIsUpper ? strtoupper($this->key[$keyIndex]) : strtolower($this->key[$keyIndex])
                ) - $offset; //get char
                $k = -$k; //if decrypt do function reverse way
                $ch = chr(($this->mod(((ord($this->text[$i]) + $k) - $offset), 26)) + $offset); //get new char
                $output .= $ch;
            } else {
                $output .= $this->text[$i];
                $nonAlphaCharCount++;
            }
        }

        return new BasicOutput(
            inputValue: $this->text,
            operation: $this->operation,
            key: $this->key,
            outputValue: $output
        );
    }
}
