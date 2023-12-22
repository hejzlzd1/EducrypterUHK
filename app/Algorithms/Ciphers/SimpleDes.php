<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\Output\BasicOutput;
use Exception;

/**
 * Implementation of SimpleDES algorithm
 *
 * @author hejzlzd1
 */
class SimpleDes extends BlockCipher
{
    private BasicOutput $output;

    private string $firstHalfKey;

    private string $secondHalfKey;

    /**
     * Predefined sboxes
     * @var array<array-key, int[][]> $sBoxes
     */
    private array $sBoxes = [
        [
            [1,0,3,2],
            [3,2,1,0],
            [0,2,1,3],
            [3,1,3,2]
        ],
        [
            [0,1,2,3],
            [2,0,1,3],
            [3,0,1,0],
            [2,1,0,3]
        ]
    ];

    /**
     * Prepare subkeys
     */
    public function __construct(string $text, string $key, int $operation)
    {
        $this->output = new BasicOutput($text, $key, $operation);
        $this->output->setSteps([]); // TODO remove this after implementation of stepping
        if (mb_strlen($key) < 10) {
            $key = str_pad($key, 10, 0, STR_PAD_LEFT);
        }
        if (mb_strlen($text) < 8) {
            $text = str_pad($text, 8, 0, STR_PAD_LEFT);
        }
        $this->keyGeneration($key);
        parent::__construct($text, $key, $operation);
    }

    /**
     * This function takes binary key as input and performs key generation.
     * @param string $key
     * @return void
     */
    public function keyGeneration(string $key): void
    {
        // Permutation is first step
        $permutedKey = $this->permutation(str_split($key), [3, 5, 2, 7, 4, 10, 1, 9, 8, 6]);

        // Split permuted key into two parts
        [$firstHalfKey, $secondHalfKey] = array_chunk($permutedKey, 5);

        // Left shift both parts of key
        $firstHalfKey = $this->leftShift($firstHalfKey);
        $secondHalfKey = $this->leftShift($secondHalfKey);

        // Perform P8 on both parts of key (merged in method) -> this creates first part of 8bit key
        $this->firstHalfKey = implode('', $this->permutation(array_merge($firstHalfKey, $secondHalfKey), [6, 3, 7, 4, 8, 5, 10, 9]));

        // Two bit shift on both parts of key
        for ($i = 0; $i < 2; $i++) {
            $firstHalfKey = $this->leftShift($firstHalfKey);
            $secondHalfKey = $this->leftShift($secondHalfKey);
        }

        // Perform P8 on both parts of key (merged in method) -> this creates second part of 8bit key
        $this->secondHalfKey = implode('', $this->permutation(array_merge($firstHalfKey, $secondHalfKey), [6, 3, 7, 4, 8, 5, 10, 9]));
    }

    /**
     * Takes binary array and performs left shift by one position. Returns shifted array.
     * @param array<array-key, string> $input
     * @return array<array-key, string>
     */
    public function leftShift(array $input): array
    {
        // Use array_shift to remove the first element and return it
        $firstElement = array_shift($input);

        // Use array_push to add the first element at the end of the array
        $input[] = $firstElement;

        return $input;
    }

    /**
     * This method performs permutation based on array indexes
     * Returns permuted data
     * @param array<array-key, string> $input
     * @param array<array-key, int> $permutationPositions
     * @return array
     */
    private function permutation(array $input, array $permutationPositions): array
    {
        // Initialize an empty string for the output
        $output = [];

        // Perform the permutation
        foreach ($permutationPositions as $position) {
            // Append the bit at the specified position to the output
            $output[] = $input[$position - 1];
        }

        return $output;
    }

    /**
     * Takes two binary arrays and performs XOR between them
     * @param array<array-key, string> $firstInput
     * @param array<array-key, string> $secondInput
     * @return array<array-key, string>
     * @throws Exception
     */
    private function xor(array $firstInput, array $secondInput): array {
        if (count($firstInput) !== count($secondInput)) {
            throw new Exception(trans('Cannot xor two different sized inputs'));
        }
        $output = [];
        foreach ($firstInput as $index => $binaryValue) {
            $output[] = $binaryValue === $secondInput[$index] ? '0' : '1';
        }

        return $output;
    }

    /**
     * Takes binary array and performs sbox permutation depending on specified sbox number
     * Returns permuted array
     * @param array<array-key, string> $input
     * @param int $sboxNumber
     * @return array
     */
    private function sboxPermutation(array $input, int $sboxNumber): array {
        $row = bindec($input[0] . $input[3]);
        $col = bindec($input[1] . $input[2]);

        // Get the value from the S-box
        $outputValue = $this->sBoxes[$sboxNumber][$row][$col];

        // Convert the output value to a 2-bit binary string
        return str_split(str_pad(decbin($outputValue), 2, '0', STR_PAD_LEFT));
    }

    /**
     * This method is used to perform complex function (permutation & xor operations)
     * Returns binary array
     * https://media.geeksforgeeks.org/wp-content/uploads/20210205163905/GFGPage3.png
     * @param array<array-key, string> $leftHalf
     * @param array<array-key, string> $rightHalf
     * @param array<array-key, string> $key
     * @return string[]
     * @throws Exception
     */
    private function complexFunction(array $leftHalf, array $rightHalf, array $key): array {
        $permutedSecondHalf = $this->permutation($rightHalf, [4, 1, 2, 3, 2, 3, 4, 1]);
        $xorOutput = $this->xor($permutedSecondHalf, $key);
        [$xorFirst, $xorSecond] = array_chunk($xorOutput, 4);

        $xorFirstAfterSBox = $this->sboxPermutation($xorFirst, 0);
        $xorSecondAfterSBox = $this->sboxPermutation($xorSecond, 1);

        $mergedXor = array_merge($xorFirstAfterSBox, $xorSecondAfterSBox);
        $p4 = $this->permutation($mergedXor, [2, 4, 3, 1]);
        return $this->xor($leftHalf, $p4);
    }

    /**
     * Simple array swap.
     * Left = Right && Right = Left
     * @param array<array-key, string> $leftHalf
     * @param array<array-key, string> $rightHalf
     * @return array
     */
    private function swap(array $leftHalf, array $rightHalf): array
    {
        $temp = $rightHalf;
        $rightHalf = $leftHalf;
        $leftHalf = $temp;

        return [$leftHalf, $rightHalf];
    }

    /**
     * Public function to encrypt plain string
     */
    public function encrypt(): BasicOutput
    {
        // Init permutation
        $permutedText = $this->permutation(str_split($this->text), [2, 6, 3, 1, 4, 8, 5, 7]);

        [$leftHalf, $rightHalf] = array_chunk($permutedText,4);

        // Complex function
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->firstHalfKey));

        // Swap half sides
        [$leftHalf, $rightHalf] = $this->swap($leftHalf, $rightHalf);

        // Perform complex function again but with swapped sides
        // TODO fix this
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->secondHalfKey));

        // Merge and perform inverse permutation
        $mergedOutputs = array_merge($leftHalf, $rightHalf);
        $output = $this->permutation($mergedOutputs, [4, 1, 3, 5, 7, 2, 8, 6]);
        dd($output);
        $this->output->setOutputValue(implode('',$output));
        //TODO add steps
        return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     */
    public function decrypt(): BasicOutput
    {
        // Init permutation
        $permutedText = $this->permutation(str_split($this->text), [4, 1, 3, 5, 7, 2, 8, 6]);

        [$leftHalf, $rightHalf] = array_chunk($permutedText,4);

        // Complex function
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->firstHalfKey));

        // Swap half sides
        [$leftHalf, $rightHalf] = $this->swap($leftHalf, $rightHalf);

        // Perform complex function again but with swapped sides
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->secondHalfKey));

        // Merge and perform inverse permutation
        $mergedOutputs = array_merge($leftHalf, $rightHalf);
        $output = $this->permutation($mergedOutputs, [2, 6, 3, 1, 4, 8, 5, 7]);

        $this->output->setOutputValue(implode('',$output));
        //TODO add steps
        return $this->output; //return full encrypted text with steps
    }
}
