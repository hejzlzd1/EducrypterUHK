<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\Output\SAESOutput;
use App\Algorithms\Output\Steps\NamedStep;
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
    private SAESOutput $output;

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
        $this->output = new SAESOutput(inputValue: $text, operation: $operation, key: $key);

        $this->roundKeys = $this->generateRoundKeys($key);
        $this->output->setRoundKeys($this->roundKeys);
        parent::__construct($text, $key, $operation);
    }

    /**
     * Generate round keys for encryption/decryption.
     *
     * @param string $key
     *
     * @return array
     * @throws Exception
     */
    private function generateRoundKeys(string $key): array
    {
        $roundKeys = [];

        // Initial round key is the original key
        $roundKeys[] = $key;
        $roundKeysSteps[] = new NamedStep('-', $key, trans('simpleAesPageTexts.addRoundKey') . ' K0');

        // Make array from key
        $key = str_split($key);

        // Split key array into two 8-bit words
        $w0 = array_slice($key, 0, 8);
        $w1 = array_slice($key, 8);

        $roundKeysSteps[] = new NamedStep(implode($key), sprintf('W0 = %s, W1 = %s', implode($w0), implode($w1)), trans('simpleAesPageTexts.splitKey'));

        // Perform key expansion
        $w2 = $this->xor($w0, str_split('10000000'));
        $roundKeysSteps[] = new NamedStep(sprintf('W0 - %s', implode($w0)), sprintf('W2 = %s', implode($w2)), 'W2 = W0 ⊕ 10000000');

        $step = new NamedStep(input: sprintf('W1 - %s', implode($w1)), translatedActionName: 'W1 - ' . trans('simpleAesPageTexts.rotateKey')); // create step
        $w1 = $this->rotateKey($w1); // rotate key
        $step->setOutput(sprintf('W1 = %s', implode($w1))); // set output of action
        $roundKeysSteps[] = $step; // add to steps - output

        $step = new NamedStep(input: sprintf('W1 - %s', implode($w1)), translatedActionName: 'W1 - ' . trans('simpleAesPageTexts.substituteNibbles')); // create step
        $w1 = $this->substituteNibbles($w1); // substitute nibble
        $step->setOutput(sprintf('W1 = %s', implode($w1))); // set output of action
        $roundKeysSteps[] = $step; // add to steps - output

        $step = new NamedStep(input: sprintf('W1 - %s, W2 - %s', implode($w1), implode($w2)), translatedActionName: 'W2 = W2 ⊕ W1'); // create step
        $w2 = $this->xor($w2, $w1); // xor
        $step->setOutput(sprintf('W2 = %s', implode($w2))); // set output of action
        $roundKeysSteps[] = $step; // add to steps - output


        $w3 = $this->xor($w2, $w1);
        $roundKeysSteps[] = new NamedStep(sprintf('W1 - %s, W2 - %s', implode($w1), implode($w2)), sprintf('W3 = %s', implode($w3)), 'W3 = W2 ⊕ W1');

        $w4 = $this->xor($w2, str_split('00110000'));
        $roundKeysSteps[] = new NamedStep(sprintf('W2 - %s', implode($w2)), sprintf('W4 = %s', implode($w4)), 'W4 = W2 ⊕ 00110000');

        $step = new NamedStep(input: sprintf('W3 - %s', implode($w3)), translatedActionName: 'W3 - ' . trans('simpleAesPageTexts.rotateKey')); // create step
        $w3 = $this->rotateKey($w3); // rotate key
        $step->setOutput(sprintf('W3 = %s', implode($w3))); // set output of action
        $roundKeysSteps[] = $step; // add to steps - output

        $step = new NamedStep(input: sprintf('W3 - %s', implode($w3)), translatedActionName: 'W3 - ' . trans('simpleAesPageTexts.substituteNibbles')); // create step
        $w3 = $this->substituteNibbles($w3); // substitute nibble
        $step->setOutput(sprintf('W3 = %s', implode($w3))); // set output of action
        $roundKeysSteps[] = $step; // add to steps - output

        $step = new NamedStep(input: sprintf('W3 - %s, W4 - %s', implode($w3), implode($w4)), translatedActionName: 'W4 = W4 ⊕ W3'); // create step
        $w4 = $this->xor($w4, $w3); // xor
        $step->setOutput(sprintf('W4 = %s', implode($w4))); // set output of action
        $roundKeysSteps[] = $step; // add to steps - output

        $w5 = $this->xor($w4, $w3);
        $roundKeysSteps[] = new NamedStep(sprintf('W3 - %s, W4 - %s', implode($w3), implode($w4)), sprintf('W5 = %s', implode($w5)), 'W5 = W2 ⊕ W1');

        // Add the expanded round keys and corresponding steps to output
        $roundKeys[] = implode('', array_merge($w2, $w3));
        $roundKeysSteps[] = new NamedStep(sprintf('W2 - %s, W3 - %s', implode($w2), implode($w3)), sprintf('K1 = %s', implode(array_merge($w2, $w3))), trans('simpleAesPageTexts.addRoundKey') . ' K1 = W2 + W3');

        $roundKeys[] = implode('', array_merge($w4, $w5));
        $roundKeysSteps[] = new NamedStep(sprintf('W4 - %s, W5 - %s', implode($w4), implode($w5)), sprintf('K2 = %s', implode(array_merge($w4, $w5))), trans('simpleAesPageTexts.addRoundKey') . ' K2 = W4 + W5');

        $this->output->setGenerationSteps($roundKeysSteps);

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
    private function performRound(array $value, string $roundKey, bool $performMix = false): array
    {
        $chunks = array_chunk($value, 4);
        $nibbles = array_map(function (array $chunk): string {
            return implode('', $this->getSubstitutionValue($chunk));
        }, $chunks);
        $this->output->addStep(new NamedStep(implode($value), implode($nibbles), trans('simpleAesPageTexts.substituteNibbles')));

        $step = new NamedStep(input: sprintf('S00 - %s, S01 - %s, S10 - %s, S11 - %s', $nibbles[0], $nibbles[1], $nibbles[2], $nibbles[3]), translatedActionName: trans('simpleAesPageTexts.shiftRow'));
        // Shift row function (swap two array elements)
        $nibbles = [$nibbles[0], $nibbles[3], $nibbles[2], $nibbles[1]];
        $step->setOutput(sprintf('S00 - %s, S01 - %s, S10 - %s, S11 - %s', $nibbles[0], $nibbles[1], $nibbles[2], $nibbles[3]));
        $this->output->addStep($step);

        // Mix columns if required
        if ($performMix) {
            $step = new NamedStep(input: sprintf('S00 - %s, S01 - %s, S10 - %s, S11 - %s', $nibbles[0], $nibbles[1], $nibbles[2], $nibbles[3]), translatedActionName: trans('simpleAesPageTexts.encryptMixNibbles'));

            $nibbles = [[bindec($nibbles[0]), bindec($nibbles[1])], [bindec($nibbles[2]), bindec($nibbles[3])]];
            $nibbles = $this->mixColumns($nibbles, true); // mix nibbles

            $step->setOutput(implode($nibbles));
            $this->output->addStep($step);
        }

        $keyNum = ($performMix ? '1' : '2');
        $step = new NamedStep(input: sprintf('IN - %s, K%d - %s', implode($nibbles), $keyNum, $roundKey), translatedActionName: 'IN ⊕ K' . $keyNum); // Not nice code - check if first round (mixColumn) was called => set key according to that (wouldn't work on real AES)
        $nibbles = $this->addRoundKey(str_split(implode('',$nibbles)), str_split($roundKey));

        $step->setOutput(sprintf('IN = %s', implode($nibbles)));
        $this->output->addStep($step);

        return $nibbles;
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
     * @return SAESOutput
     *
     * @throws Exception
     */
    public function encrypt(): SAESOutput
    {
        $text = str_split($this->text);
        $value = $this->addRoundKey($text, str_split($this->roundKeys[0]));
        $this->output->addStep(new NamedStep(implode($text), implode($value), 'IN ⊕ K0'));

        // Perform encryption rounds
        for ($i = 1; $i <= 2; $i++) {
            $value = $this->performRound($value, $this->roundKeys[$i], $i === 1);
        }

        $this->output->setOutputValue(implode($value));

        return $this->output;
    }

    /**
     * Decrypt the ciphertext.
     *
     * @return SAESOutput
     *
     * @throws Exception
     */
    public function decrypt(): SAESOutput
    {
        $text = str_split($this->text);
        $value = $this->addRoundKey($text, str_split($this->roundKeys[2]));
        $this->output->addStep(new NamedStep(implode($text), implode($value), 'IN ⊕ K2'));

        // Perform decryption rounds
        for ($i = 2; $i > 0; $i--) {
            $value = $this->performDecryptionRound($value, $this->roundKeys[$i-1], $i === 2);
        }
        $this->output->setOutputValue(implode($value));

        return $this->output;
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
    private function performDecryptionRound(array $value, string $roundKey, bool $performMix = false): array
    {
        $nibbles = array_chunk($value, 4);

        $step = new NamedStep(input: sprintf('S00 - %s, S01 - %s, S10 - %s, S11 - %s', implode($nibbles[0]), implode($nibbles[1]), implode($nibbles[2]), implode($nibbles[3])), translatedActionName: trans('simpleAesPageTexts.shiftRow'));
        // Shift row function (swap two array elements)
        $nibbles = [$nibbles[0], $nibbles[3], $nibbles[2], $nibbles[1]];
        $step->setOutput(sprintf('S00 - %s, S01 - %s, S10 - %s, S11 - %s', implode($nibbles[0]), implode($nibbles[1]), implode($nibbles[2]), implode($nibbles[3])));
        $this->output->addStep($step);

        $nibbles = array_map(function (array $chunk): string {
            return implode('', $this->getSubstitutionValue($chunk, true));
        }, $nibbles);
        $this->output->addStep(new NamedStep(implode($value), implode($nibbles), trans('simpleAesPageTexts.substituteNibbles')));

        $keyNum = ($performMix ? '1' : '0');
        $step = new NamedStep(input: sprintf('IN - %s, K%d - %s', implode($nibbles), $keyNum, $roundKey), translatedActionName: 'IN ⊕ K' . $keyNum); // Not nice code - check if first round (mixColumn) was called => set key according to that (wouldn't work on real AES)
        $nibbles = $this->addRoundKey(str_split(implode('', $nibbles)), str_split($roundKey));

        $step->setOutput(sprintf('IN = %s', implode($nibbles)));
        $this->output->addStep($step);

        $nibbles = str_split(implode(array_merge($nibbles)), 4);

        // Mix columns if required
        if ($performMix) {
            $step = new NamedStep(input: sprintf('S00 - %s, S01 - %s, S10 - %s, S11 - %s', $nibbles[0], $nibbles[1], $nibbles[2], $nibbles[3]), translatedActionName: trans('simpleAesPageTexts.decryptMixNibbles'));

            $nibbles = [[bindec($nibbles[0]), bindec($nibbles[1])], [bindec($nibbles[2]), bindec($nibbles[3])]];
            $nibbles = str_split(implode(array_merge($this->mixColumns($nibbles, false))));

            $step->setOutput(implode($nibbles));
            $this->output->addStep($step);
        }

        return $nibbles;
    }
}
