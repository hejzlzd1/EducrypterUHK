<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use Exception;

/**
 * Implementation of SimpleAES algorithm
 * @see https://www.rose-hulman.edu/class/ma/holden/Archived_Courses/Math479-0304/lectures/s-aes.pdf
 * @see https://sandilands.info/sgordon/teaching/reports/simplified-aes-example.pdf
 * @author hejzlzd1
 */
class SimpleAes extends BlockCipher {
    // S-boxes for substitution
    private $sBox = ['1001', '0100', '1010', '1011', '1101', '0001', '1000', '0101', '0110', '0010', '0000', '0011', '1100', '1110', '1111', '0111'];
    private $sBoxInverse = ['1010', '0101', '1001', '1011', '0001', '0111', '1000', '1111', '0110', '0000', '0010', '0011', '1100', '0100', '1101', '1110'];
    private array $roundKeys = [];

    /**
     * SimpleAes constructor.
     *
     * @param string $text
     * @param string $key
     * @param int $operation
     *
     * @throws Exception
     */
    public function __construct(string $text, string $key, int $operation)
    {
        $key = str_pad($key, 16, '0', STR_PAD_LEFT);
        $text = str_pad($text, 16, '0', STR_PAD_LEFT);

        $this->roundKeys = $this->generateRoundKeys($key);
        parent::__construct($text, $key, $operation);
    }

    /**
     * Generate round keys for encryption/decryption.
     *
     * @param string $key
     *
     * @return array
     */
    private function generateRoundKeys(string $key): array
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

        // Add the expanded round keys
        $roundKeys[] = implode('', array_merge($w2, $w3));
        $roundKeys[] = implode('', array_merge($w4, $w5));

        return $roundKeys;
    }

    /**
     * Rotate key for key expansion.
     *
     * @param array $key
     *
     * @return array
     */
    private function rotateKey(array $key): array
    {
        return array_merge(array_slice($key, 4), array_slice($key, 0, 4));
    }

    /**
     * Substitute nibbles using S-boxes.
     *
     * @param array $nibble
     *
     * @return array
     */
    private function substituteNibbles(array $nibble): array
    {
        [$w0, $w1] = array_chunk($nibble, 4);
        return array_merge($this->getSubstitutionValue($w0), $this->getSubstitutionValue($w1));
    }

    /**
     * Get substitution value from S-box.
     *
     * @param array $value
     * @param bool $inverse
     *
     * @return array
     */
    private function getSubstitutionValue(array $value, bool $inverse = false): array
    {
        $value = bindec(implode($value));
        return str_split($inverse ? $this->sBoxInverse[$value] : $this->sBox[$value]);
    }

    /**
     * Perform a single round of encryption.
     *
     * @param array $value
     * @param bool $performMix
     * @param string $roundKey
     *
     * @return array
     */
    private function performRound(array $value, bool $performMix = false, string $roundKey): array
    {
        $chunks = array_chunk($value, 4);
        $nibbles = array_map(function (array $chunk): string {
            return implode('', $this->getSubstitutionValue($chunk));
        }, $chunks);

        // Shift row function (swap two array elements)
        $nibbles = [$nibbles[0], $nibbles[3], $nibbles[2], $nibbles[1]];

        // Mix columns if required
        if ($performMix) {
            $nibbles = $this->mixColumns([$nibbles[0], $nibbles[1]], $this->operation === CipherBase::ALGORITHM_ENCRYPT);
        }

        // Add round key
        return $this->addRoundKey(str_split(implode('', $nibbles)), str_split($roundKey));
    }

    /**
     * Mix columns transformation.
     *
     * @param array $nibbles
     * @param bool $isEncrypt
     *
     * @return array
     */
    private function mixColumns(array $nibbles, bool $isEncrypt): array
    {
        $mixedNibbles = [];

        for ($i = 0; $i < 2; $i++) {
            $mixedNibbles[] = $this->mixColumn($nibbles[$i], $isEncrypt);
        }

        return array_merge($mixedNibbles[0], $mixedNibbles[1]);
    }

    /**
     * Mix a single column.
     *
     * @param array $column
     * @param bool $isEncrypt
     *
     * @return array
     */
    private function mixColumn(array $column, bool $isEncrypt): array
    {
        $mixedColumn = [];
        $coefficients = $isEncrypt ? [1, 4] : [9, 2];

        $mixedColumn[0] = str_pad(decbin($this->gfMultiply($column[0], $coefficients[0]) ^ $this->gfMultiply($column[1], $coefficients[1])), 4, '0', STR_PAD_LEFT);
        $mixedColumn[1] = str_pad(decbin($this->gfMultiply($column[0], $coefficients[1]) ^ $this->gfMultiply($column[1], $coefficients[0])), 4, '0', STR_PAD_LEFT);

        return $mixedColumn;
    }

    /**
     * Galois Field multiplication.
     *
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    private function gfMultiply(int $a, int $b): int
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
     * Add round key to the input.
     *
     * @param array $input
     * @param array $key
     *
     * @return array
     */
    private function addRoundKey(array $input, array $key): array
    {
        return $this->xor($input, $key);
    }

    /**
     * Encrypt the plaintext.
     *
     * @return BasicOutput
     *
     * @throws Exception
     */
    public function encrypt(): BasicOutput
    {
        $text = str_split($this->text);
        $value = $this->addRoundKey($text, str_split($this->roundKeys[0]));

        // Perform encryption rounds
        for ($i = 1; $i <= 2; $i++) {
            $value = $this->performRound($value, $i === 1, $this->roundKeys[$i]);
        }

        return new BasicOutput($this->text, $this->operation, $this->key, implode('', $value));
    }

    /**
     * Decrypt the ciphertext.
     *
     * @return BasicOutput
     *
     * @throws Exception
     */
    public function decrypt(): BasicOutput
    {
        $text = str_split($this->text);
        $value = $this->addRoundKey($text, str_split($this->roundKeys[2]));

        // Perform decryption rounds
        for ($i = 2; $i > 0; $i--) {
            $value = $this->performDecryptionRound($value, $i === 2, $this->roundKeys[$i-1]);
        }

        return new BasicOutput($this->text, $this->operation, $this->key, implode('', $value));
    }

    /**
     * Perform a single round of decryption.
     *
     * @param array $value
     * @param bool $performMix
     * @param string $roundKey
     *
     * @return array
     */
    private function performDecryptionRound(array $value, bool $performMix = false, string $roundKey): array
    {
        $nibbles = array_chunk($value, 4);
        $nibbles = [$nibbles[0], $nibbles[3], $nibbles[2], $nibbles[1]];

        $nibbles = array_map(function (array $chunk): string {
            return implode('', $this->getSubstitutionValue($chunk, true));
        }, $nibbles);

        $nibbles = $this->addRoundKey(str_split(implode('', $nibbles)), str_split($roundKey));

        $nibbles = str_split(implode(array_merge($nibbles)), 4);

        // Mix columns if required
        if ($performMix) {
            $nibbles = [[bindec($nibbles[0]), bindec($nibbles[1])], [bindec($nibbles[2]), bindec($nibbles[3])]];
            $nibbles = str_split(implode(array_merge($this->mixColumns($nibbles, false))));
        }

        return $nibbles;
    }
}
