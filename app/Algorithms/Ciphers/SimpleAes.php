<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\Output\BasicOutput;
use Exception;

/**
 * Implementation of SimpleAES algorithm
 *
 * @author hejzlzd1
 */
class SimpleAes extends BlockCipher
{

    // Predefined sboxes

    private $sBox = [
        '1001', '0100', '1010', '1011',
        '1101', '0001', '1000', '0101',
        '0110', '0010', '0000', '0011',
        '1100', '1111', '1110', '0111',
    ];

    private $sBoxInverse = [
        '1010', '0101', '1001', '1011',
        '0001', '0111', '1000', '1111',
        '0110', '0000', '0010', '0011',
        '1100', '0100', '1101', '1110'
    ];

    private array $roundKeys = [];

    /**
     * Prepare subkeys
     */
    public function __construct(string $text, string $key, int $operation)
    {

        if (mb_strlen($key) < 16) {
            $key = str_pad($key, 16, 0, STR_PAD_LEFT);
        }
        if (mb_strlen($text) < 16) {
            $text = str_pad($text, 16, 0, STR_PAD_LEFT);
        }

        $this->roundKeys = $this->generateRoundKeys($key);
        parent::__construct($text, $key, $operation);
    }

    private function generateRoundKeys(string $key) {
        $roundKeys = [];

        // Initial round key is the original key
        $roundKeys[] = $key;

        $key = str_split($key);
        // Split key into two 8-bit words
        $w0 = array_slice($key, 0, 8);
        $w1 = array_slice($key, 8);

        // Perform key expansion
        $w2 = $this->xor($w0, str_split('10000000'));
        $subNib = $this->substituteNibbles($this->rotateKey($w1));
        $w2 = $this->xor($w2, $subNib);
        $w3 = $this->xor($w2, $w1);
        $w4 = $this->xor($w2, str_split('00110000'));
        $w4 = $this->xor($w4, $this->substituteNibbles($this->rotateKey($w3)));
        $w5 = $this->xor($w4, $w3);

        $roundKeys[] = implode('', array_merge($w2,$w3));
        $roundKeys[] = implode('', array_merge($w4, $w5));

        return $roundKeys;
    }

    private function rotateKey($key): array
    {
        return array_merge(array_slice($key, 4), array_slice($key, 0, 4));
    }

    private function substituteNibbles($nibble): array
    {
        [$w0, $w1] = array_chunk($nibble, 4);

        return array_merge($this->getSubstitutionValue($w0), $this->getSubstitutionValue($w1));
    }

    private function getSubstitutionValue(array $value) {
        $value = bindec(implode($value));
        return str_split($this->sBox[$value]);
    }

    /**
     * This method is used to perform round function
     * Returns binary array
     * @see https://www.rose-hulman.edu/class/ma/holden/Archived_Courses/Math479-0304/lectures/s-aes.pdf
     * @see https://sandilands.info/sgordon/teaching/reports/simplified-aes-example.pdf
     * @param array<string> $key
     * @return string[]
     * @throws Exception
     */
    private function roundFunction(array $key): array
    {
        //todo implement
        return [];
    }

    /**
     * Public function to encrypt plain string
     */
    public function encrypt(): BasicOutput
    {

        return new BasicOutput('test', 1, 1);
        //return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     */
    public function decrypt(): BasicOutput
    {
        return new BasicOutput('test', 1, 1);
        // return $this->output; //return full encrypted text with steps
    }
}
