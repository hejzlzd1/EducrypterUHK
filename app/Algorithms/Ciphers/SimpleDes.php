<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\SDESOutput;
use App\Algorithms\Output\Steps\NamedStep;
use Exception;

/**
 * Implementation of SimpleDES algorithm
 *
 * @author hejzlzd1
 */
class SimpleDes extends BlockCipher
{
    private SDESOutput $output;

    private string $firstHalfKey;

    private string $secondHalfKey;

    /**
     * Predefined sboxes
     * @var array<int[][]> $sBoxes
     */
    private array $sBoxes = [
        [
            [1, 0, 3, 2],
            [3, 2, 1, 0],
            [0, 2, 1, 3],
            [3, 1, 3, 2]
        ],
        [
            [0, 1, 2, 3],
            [2, 0, 1, 3],
            [3, 0, 1, 0],
            [2, 1, 0, 3]
        ]
    ];

    /**
     * Prepare subkeys
     */
    public function __construct(string $text, string $key, int $operation)
    {
        $this->output = new SDESOutput(inputValue: $text, operation: $operation, key: $key);

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
        // Permutation is first step - P10
        $permutedKey = $this->permutation(str_split($key), [3, 5, 2, 7, 4, 10, 1, 9, 8, 6]);
        $this->output->addKeyGenerationStep(new NamedStep(input: $key, output: implode('', $permutedKey), translatedActionName: trans('simpleDesPageTexts.P10')));

        // Split permuted key into two parts
        [$leftKey, $rightKey] = array_chunk($permutedKey, 5);
        $this->output->addKeyGenerationStep(new NamedStep(input: implode('', $permutedKey), output: implode('', $leftKey) . ' | ' . implode('', $rightKey), translatedActionName: trans('simpleDesPageTexts.split')));

        // Left shift both parts of key
        $firstHalfKey = $this->leftShift($leftKey);
        $this->output->addKeyGenerationStep(new NamedStep(input: implode('', $leftKey), output: implode('', $firstHalfKey), translatedActionName: trans('simpleDesPageTexts.leftShiftLeftKey')));

        $secondHalfKey = $this->leftShift($rightKey);
        $this->output->addKeyGenerationStep(new NamedStep(input: implode('', $rightKey), output: implode('', $secondHalfKey), translatedActionName: trans('simpleDesPageTexts.leftShiftRightKey')));

        // Perform P8 on both parts of key (merged in method) -> this creates first part of 8bit key
        $this->firstHalfKey = implode('', $this->permutation(array_merge($firstHalfKey, $secondHalfKey), [6, 3, 7, 4, 8, 5, 10, 9]));
        $this->output->addKeyGenerationStep(new NamedStep(input: implode('', array_merge($firstHalfKey, $secondHalfKey)), output: implode('', $secondHalfKey), translatedActionName: trans('simpleDesPageTexts.P8KeyOutput', ['keyNumber' => 1])));

        // Two bit shift on both parts of key
        for ($i = 0; $i < 2; $i++) {
            $step = new NamedStep(input: implode('', $firstHalfKey), translatedActionName: trans('simpleDesPageTexts.leftShiftLeftKey'));
            $firstHalfKey = $this->leftShift($firstHalfKey);
            $step->setOutput(implode('', $firstHalfKey));
            $this->output->addKeyGenerationStep($step);

            $step = new NamedStep(input: implode('', $secondHalfKey), translatedActionName: trans('simpleDesPageTexts.leftShiftRightKey'));
            $secondHalfKey = $this->leftShift($secondHalfKey);
            $step->setOutput(implode('', $firstHalfKey));
            $this->output->addKeyGenerationStep($step);
        }

        // Perform P8 on both parts of key (merged in method) -> this creates second part of 8bit key
        $this->secondHalfKey = implode('', $this->permutation(array_merge($firstHalfKey, $secondHalfKey), [6, 3, 7, 4, 8, 5, 10, 9]));
        $this->output->addKeyGenerationStep(new NamedStep(input: implode('', array_merge($firstHalfKey, $secondHalfKey)), output: implode('', $secondHalfKey), translatedActionName: trans('simpleDesPageTexts.P8KeyOutput', ['keyNumber' => 2])));
    }

    /**
     * Takes binary array and performs left shift by one position. Returns shifted array.
     * @param array<string> $input
     * @return array<string>
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
     * @param array<string> $input
     * @param array<int> $permutationPositions
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
     * Takes binary array and performs sbox permutation depending on specified sbox number
     * Returns permuted array
     * @param array<string> $input
     * @param int $sboxNumber
     * @return array
     */
    private function sboxPermutation(array $input, int $sboxNumber): array
    {
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
     * @param array<string> $leftHalf
     * @param array<string> $rightHalf
     * @param array<string> $key
     * @return string[]
     * @throws Exception
     */
    private function complexFunction(array $leftHalf, array $rightHalf, array $key): array
    {
        $permutedSecondHalf = $this->permutation($rightHalf, [4, 1, 2, 3, 2, 3, 4, 1]);
        $this->output->addStep(new NamedStep(input: implode('', $rightHalf), output: implode('', $permutedSecondHalf), translatedActionName: trans('simpleDesPageTexts.EP')));

        $xorOutput = $this->xor($permutedSecondHalf, $key);
        $this->output->addStep(new NamedStep(input: implode('', $permutedSecondHalf) . ' ⊕ ' . implode('', $key), output: implode('', $xorOutput), translatedActionName: trans('simpleDesPageTexts.xor')));

        [$xorFirst, $xorSecond] = array_chunk($xorOutput, 4);
        $this->output->addStep(new NamedStep(input: implode('', $xorOutput), output: implode('', $xorFirst) . ' | ' . implode('', $xorSecond), translatedActionName: trans('simpleDesPageTexts.split')));

        $xorFirstAfterSBox = $this->sboxPermutation($xorFirst, 0);
        $this->output->addStep(new NamedStep(input: implode('', $xorOutput), output: implode('', $xorFirstAfterSBox), translatedActionName: trans('simpleDesPageTexts.SBoxPermutation', ['boxNumber' => 0])));

        $xorSecondAfterSBox = $this->sboxPermutation($xorSecond, 1);
        $this->output->addStep(new NamedStep(input: implode('', $xorOutput), output: implode('', $xorSecondAfterSBox), translatedActionName: trans('simpleDesPageTexts.SBoxPermutation', ['boxNumber' => 1])));

        $mergedXor = array_merge($xorFirstAfterSBox, $xorSecondAfterSBox);
        $p4 = $this->permutation($mergedXor, [2, 4, 3, 1]);
        $this->output->addStep(new NamedStep(input: implode('', $mergedXor), output: implode('', $p4), translatedActionName: trans('simpleDesPageTexts.P4')));

        $xor = $this->xor($leftHalf, $p4);
        $this->output->addStep(new NamedStep(input: implode('', $leftHalf) . ' ⊕ ' . implode('', $p4), output: implode('', $xor), translatedActionName: trans('simpleDesPageTexts.xor')));

        return $xor;
    }

    /**
     * Simple array swap.
     * Left = Right && Right = Left
     * @param array<string> $leftHalf
     * @param array<string> $rightHalf
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
    public function encrypt(): SDESOutput
    {
        // Init permutation
        $permutedText = $this->permutation(str_split($this->text), [2, 6, 3, 1, 4, 8, 5, 7]);
        $this->output->addStep(new NamedStep(input: $this->text, output: implode('', $permutedText), translatedActionName: trans('simpleDesPageTexts.IP')));

        [$leftHalf, $rightHalf] = array_chunk($permutedText, 4);
        $this->output->addStep(new NamedStep(input: implode('', $permutedText), output: implode('', $leftHalf) . ' | ' . implode('', $rightHalf), translatedActionName: trans('simpleDesPageTexts.split')));

        // Complex function
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->firstHalfKey));

        // Swap half sides
        [$leftHalf, $rightHalf] = $this->swap($leftHalf, $rightHalf);
        $this->output->addStep(new NamedStep(input: implode('', $rightHalf) . ' | ' . implode('', $leftHalf), output: implode('', $leftHalf) . ' | ' . implode('', $rightHalf), translatedActionName: trans('simpleDesPageTexts.swap')));

        // Perform complex function again but with swapped sides
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->secondHalfKey));

        // Merge and perform inverse permutation
        $mergedOutputs = array_merge($leftHalf, $rightHalf);
        $output = $this->permutation($mergedOutputs, [4, 1, 3, 5, 7, 2, 8, 6]);
        $this->output->addStep(new NamedStep(input: implode('', $mergedOutputs), output: implode('', $output), translatedActionName: trans('simpleDesPageTexts.IIP')));

        $this->output->setOutputValue(implode('', $output));
        return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     */
    public function decrypt(): SDESOutput
    {
        // Init permutation
        $permutedText = $this->permutation(str_split($this->text), [2, 6, 3, 1, 4, 8, 5, 7]);
        $this->output->addStep(new NamedStep(input: $this->text, output: implode('', $permutedText), translatedActionName: trans('simpleDesPageTexts.IP')));

        [$leftHalf, $rightHalf] = array_chunk($permutedText, 4);
        $this->output->addStep(new NamedStep(input: implode('', $permutedText), output: implode('', $leftHalf) . ' | ' . implode('', $rightHalf), translatedActionName: trans('simpleDesPageTexts.split')));

        // Complex function
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->secondHalfKey));

        // Swap half sides
        [$leftHalf, $rightHalf] = $this->swap($leftHalf, $rightHalf);
        $this->output->addStep(new NamedStep(input: implode('', $rightHalf) . ' | ' . implode('', $leftHalf), output: implode('', $leftHalf) . ' | ' . implode('', $rightHalf), translatedActionName: trans('simpleDesPageTexts.swap')));

        // Perform complex function again but with swapped sides
        $leftHalf = $this->complexFunction($leftHalf, $rightHalf, str_split($this->firstHalfKey));

        // Merge and perform inverse permutation
        $mergedOutputs = array_merge($leftHalf, $rightHalf);
        $output = $this->permutation($mergedOutputs, [4, 1, 3, 5, 7, 2, 8, 6]);
        $this->output->addStep(new NamedStep(input: implode('', $mergedOutputs), output: implode('', $output), translatedActionName: trans('simpleDesPageTexts.IIP')));


        $this->output->setOutputValue(implode('', $output));
        return $this->output; //return full encrypted text with steps
    }
}
