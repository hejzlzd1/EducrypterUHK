<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\Steps\Step;
use Closure;
use Exception;

/**
 * Implementation of SimpleAES algorithm
 * @see https://www.rose-hulman.edu/class/ma/holden/Archived_Courses/Math479-0304/lectures/s-aes.pdf
 * @see https://sandilands.info/sgordon/teaching/reports/simplified-aes-example.pdf
 * @author hejzlzd1
 */
class SimpleAes extends BlockCipher
{

    // Predefined sboxes

    private $sBox = [
        '1001',
        '0100',
        '1010',
        '1011',
        '1101',
        '0001',
        '1000',
        '0101',
        '0110',
        '0010',
        '0000',
        '0011',
        '1100',
        '1110',
        '1111',
        '0111',
    ];

    // fixed GF multiplier [1, 4, 1, 4]
    public const array GF_MULTIPLIER = ['0001', '0100', '0001', '0100'];

    private $sBoxInverse = [
        '1010',
        '0101',
        '1001',
        '1011',
        '0001',
        '0111',
        '1000',
        '1111',
        '0110',
        '0000',
        '0010',
        '0011',
        '1100',
        '0100',
        '1101',
        '1110'
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

    private function generateRoundKeys(string $key)
    {
        $roundKeys = [];

        // Initial round key is the original key
        $roundKeys[] = $key;

        // Make array from key
        $key = str_split($key);

        // Split key array into two 8-bit words
        $w0 = array_slice($key, 0, 8);
        $w1 = array_slice($key, 8);

        // Perform key expansion
        $w2 = $this->xor($w0, str_split('10000000'));
        $w2 = $this->xor($w2, $this->substituteNibbles($this->rotateKey($w1)));
        $w3 = $this->xor($w2, $w1);
        $w4 = $this->xor($w2, str_split('00110000'));
        $w4 = $this->xor($w4, $this->substituteNibbles($this->rotateKey($w3)));
        $w5 = $this->xor($w4, $w3);

        $roundKeys[] = implode('', array_merge($w2, $w3));
        $roundKeys[] = implode('', array_merge($w4, $w5));

        return $roundKeys;
    }

    private function rotateKey($key): array
    {
        return array_merge(array_slice($key, 4), array_slice($key, 0, 4));
    }

    /**
     * Take array split it by 4 bits to two chunks
     * Get substitution values from s-boxes for these chunks
     */
    private function substituteNibbles(array $nibble): array
    {
        [$w0, $w1] = array_chunk($nibble, 4);

        return array_merge($this->getSubstitutionValue($w0), $this->getSubstitutionValue($w1));
    }

    /**
     * Get decimal value from binary, retrieve value from s-box (substitution)
     * @param String[] $value
     * @return String[]
     */
    private function getSubstitutionValue(array $value)
    {
        $value = bindec(implode($value));
        return str_split($this->sBox[$value]);
    }

    /**
     * This method is used to perform round function
     * Returns binary array
     * @return string[]
     * @throws Exception
     */
    private function performRound(array $value, bool $performMix = false, string $roundKey): array
    {
        $chunks = array_chunk($value, 4);
        $nibbles = array_map(function (array $chunk): string {
            return implode('', $this->getSubstitutionValue($chunk));
        }, $chunks);

        // shift row function (swap two array elements)
        $nibbles = [$nibbles[0], $nibbles[3], $nibbles[2], $nibbles[1]];

        if ($performMix) {
            $nibbles = [[bindec($nibbles[0]), bindec($nibbles[1])], [bindec($nibbles[2]), bindec($nibbles[3])]];
            $nibbles = $this->mixColumns($nibbles);
        }

        $nibbles = $this->addRoundKey(str_split(implode('',$nibbles)), str_split($roundKey));

        return $nibbles;
    }

    private function mixColumns($nibbles)
    {
        $mixedNibbles = [];

        for ($i = 0; $i < 2; $i++) {
            $mixedNibbles[] = $this->mixColumn($nibbles[$i]);
        }

        return array_merge($mixedNibbles[0], $mixedNibbles[1]);
    }

    private function mixColumn($column)
    {
        $mixedColumn = [];

        $mixedColumn[0] = str_pad(decbin($this->gfMultiply($column[0], 1) ^ $this->gfMultiply($column[1], 4)), 4, '0', STR_PAD_LEFT);
        $mixedColumn[1] = str_pad(decbin($this->gfMultiply($column[0], 4) ^ $this->gfMultiply($column[1], 1)), 4, '0', STR_PAD_LEFT);

        return $mixedColumn;
    }

    private function gfMultiply($a, $b)
    {
        $result = 0;

        for ($i = 0; $i < 4; $i++) {
            if (($b & 1) != 0) {
                $result ^= $a;
            }

            $msbSet = ($a & 0x8) != 0;
            $a <<= 1;

            if ($msbSet) {
                $a ^= 0x3; // Reduce modulo x^4 + x + 1
            }

            $b >>= 1;
        }

        return $result & 0xF; // Reduce modulo x^4 + x + 1
    }

    /**
     * Input is binary, key is one of the round keys
     * Returns XOR of these two params
     * @param String[] $input
     * @param String[] $key
     * @return String[] | array{output: array<string>, steps: array<Step>}
     * @throws Exception
     */
    private function addRoundKey(array $input, array $key): array
    {
        return $this->xor($input, $key);
    }

    /**
     * Public function to encrypt plain string
     * @throws Exception
     */
    public function encrypt(): BasicOutput
    {
        $text = str_split($this->text);
        $value = $this->addRoundKey($text, str_split($this->roundKeys[0]));
        for ($i = 1; $i <= 2; $i++) {
            $value = $this->performRound($value, $i === 1 ? true : false, $this->roundKeys[$i]);
        }
        $result = implode('', $value);

        return new BasicOutput($this->text, $this->operation, $this->key, $result);
        //return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     */
    /**
     * Public function to decrypt text
     * @throws Exception
     */
    public function decrypt(): BasicOutput
    {
        //TODO implement this
        //return $this->output; //return full decrypted text with steps
    }
}
