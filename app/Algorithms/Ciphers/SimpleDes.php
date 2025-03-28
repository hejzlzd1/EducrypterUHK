<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\SDESOutput;
use App\Algorithms\Output\Steps\NamedStep;
use App\Algorithms\Output\Steps\Step;
use Exception;

/**
 * Implementation of SimpleDES algorithm
 *
 * @author hejzlzd1
 */
class SimpleDes extends BlockCipher
{
    private const P10 = [3, 5, 2, 7, 4, 10, 1, 9, 8, 6],
        P8 = [6, 3, 7, 4, 8, 5, 10, 9],
        EP = [4, 1, 2, 3, 2, 3, 4, 1],
        IP = [2, 6, 3, 1, 4, 8, 5, 7],
        IIP = [4, 1, 3, 5, 7, 2, 8, 6],
        P4 = [2, 4, 3, 1];
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
        $key = $this->expandOrTrimToSpecificBits($key, 10);
        $text = $this->expandOrTrimToSpecificBits($text, 8);

        $this->output = new SDESOutput(inputValue: $text, operation: $operation, key: $key);

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
        $permutedKey = $this->permutation(str_split($key), self::P10);
        $this->output->addKeyGenerationStep(
            new NamedStep(
                input: $key,
                output: implode($permutedKey),
                translatedActionName: trans('simpleDesPageTexts.P10'),
                imageUrl: asset('img/simpleDesPage/P10.png')
            )
        );

        // Split permuted key into two parts
        [$leftKey, $rightKey] = array_chunk($permutedKey, 5);
        $this->output->addKeyGenerationStep(
            new NamedStep(
                input: implode($permutedKey),
                output: implode($leftKey) . ' | ' . implode(
                    '',
                    $rightKey
                ),
                translatedActionName: trans('simpleDesPageTexts.split')
            )
        );

        // Left shift both parts of key
        $firstHalfKey = $this->leftShift($leftKey);
        $this->output->addKeyGenerationStep(
            new NamedStep(
                input: implode($leftKey),
                output: implode($firstHalfKey),
                translatedActionName: trans(
                    'simpleDesPageTexts.leftShiftLeftKey'
                ),
                imageUrl: asset('img/simpleDesPage/LS.png')
            )
        );

        $secondHalfKey = $this->leftShift($rightKey);
        $this->output->addKeyGenerationStep(
            new NamedStep(
                input: implode($rightKey),
                output: implode($secondHalfKey),
                translatedActionName: trans('simpleDesPageTexts.leftShiftRightKey'),
                imageUrl: asset('img/simpleDesPage/LS.png')
            )
        );

        // Perform P8 on both parts of key (merged in method) -> this creates first part of 8bit key
        $this->firstHalfKey = implode(
            '',
            $this->permutation(array_merge($firstHalfKey, $secondHalfKey), self::P8)
        );
        $this->output->addKeyGenerationStep(
            new NamedStep(
                input: implode(array_merge($firstHalfKey, $secondHalfKey)),
                output: $this->firstHalfKey,
                translatedActionName: trans(
                    'simpleDesPageTexts.P8KeyOutput',
                    ['keyNumber' => 1]
                ) . ' - ' . $this->firstHalfKey,
                imageUrl: asset('img/simpleDesPage/P8.png')
            )
        );

        // Left key shift - 2 bits
        $step = new NamedStep(
            input: implode($firstHalfKey),
            translatedActionName: trans('simpleDesPageTexts.leftShiftLeftKey') . ' - 2b',
            imageUrl: asset('img/simpleDesPage/LS.png')
        );
        $firstHalfKey = $this->leftShift($firstHalfKey, 2);
        $step->setOutput(implode($firstHalfKey));
        $this->output->addKeyGenerationStep($step);

        // Right key shift - 2 bits
        $step = new NamedStep(
            input: implode($secondHalfKey),
            translatedActionName: trans('simpleDesPageTexts.leftShiftRightKey') . ' - 2b',
            imageUrl: asset('img/simpleDesPage/LS.png')
        );

        $secondHalfKey = $this->leftShift($secondHalfKey, 2);
        $step->setOutput(implode($secondHalfKey));
        $this->output->addKeyGenerationStep($step);

        // Perform P8 on both parts of key (merged in method) -> this creates second part of 8bit key
        $this->secondHalfKey = implode(
            '',
            $this->permutation(array_merge($firstHalfKey, $secondHalfKey), self::P8)
        );

        $this->output->addKeyGenerationStep(
            new NamedStep(
                input: implode(array_merge($firstHalfKey, $secondHalfKey)),
                output: $this->secondHalfKey,
                translatedActionName: trans(
                    'simpleDesPageTexts.P8KeyOutput',
                    ['keyNumber' => 2]
                ) . ' - ' . $this->secondHalfKey,
                imageUrl: asset('img/simpleDesPage/P8.png')
            )
        );
    }

    /**
     * Takes binary array and performs left shift by one position. Returns shifted array.
     * @param array<string> $input
     * @return array<string>
     */
    public function leftShift(array $input, int $numOfShifts = 1): array
    {
        for ($i = 0; $i < $numOfShifts; $i++) {
            // Use array_shift to remove the first element and return it
            $firstElement = array_shift($input);

            // Use array_push to add the first element at the end of the array
            $input[] = $firstElement;
        }

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
     * Takes binary array and performs sbox substitution depending on specified sbox number
     * Returns permuted array
     * @param array<string> $input
     * @param int $sboxNumber
     * @return array
     */
    private function sboxSubstitution(array $input, int $sboxNumber): array
    {
        $row = bindec($input[0] . $input[3]);
        $col = bindec($input[1] . $input[2]);

        // Get the value from the S-box
        $outputValue = $this->sBoxes[$sboxNumber][$row][$col];

        // Convert the output value to a 2-bit binary string
        return str_split(str_pad(decbin($outputValue), 2, '0', STR_PAD_LEFT));
    }

    /**
     * This method is used to perform round function (permutation & xor operations)
     * Returns binary array
     * https://media.geeksforgeeks.org/wp-content/uploads/20210205163905/GFGPage3.png
     * @param array<string> $leftHalf
     * @param array<string> $rightHalf
     * @param array<string> $key
     * @return String[] | array{output: String[], steps: array<Step>}
     * @throws Exception
     */
    private function roundFunction(array $leftHalf, array $rightHalf, array $key): array
    {
        $permutedSecondHalf = $this->permutation($rightHalf, self::EP);
        $this->output->addStep(
            new NamedStep(
                input: implode($rightHalf),
                output: implode($permutedSecondHalf),
                translatedActionName: trans('simpleDesPageTexts.EP'),
                imageUrl: asset('img/simpleDesPage/EP.png')
            )
        );

        $xorOutput = $this->xor($permutedSecondHalf, $key);

        $this->output->addStep(
            new NamedStep(
                input: implode($permutedSecondHalf) . ' ⊕ ' . implode($key),
                output: implode(
                    $xorOutput
                ),
                translatedActionName: trans('simpleDesPageTexts.xor')
            )
        );

        [$xorFirst, $xorSecond] = array_chunk($xorOutput, 4);
        $this->output->addStep(
            new NamedStep(
                input: implode($xorOutput),
                output: implode($xorFirst) . ' | ' . implode($xorSecond),
                translatedActionName: trans('simpleDesPageTexts.split')
            )
        );

        /** @var array{array-key, string} $xorFirst */
        $xorFirstAfterSBox = $this->sboxSubstitution($xorFirst, 0);
        $this->output->addStep(
            new NamedStep(
                input: implode($xorOutput),
                output: implode($xorFirstAfterSBox),
                translatedActionName: trans('simpleDesPageTexts.SBoxPermutation', ['boxNumber' => 0]),
                imageUrl: asset('img/simpleDesPage/sBoxes.png')
            )
        );

        /** @var array{array-key, string} $xorSecond */
        $xorSecondAfterSBox = $this->sboxSubstitution($xorSecond, 1);
        $this->output->addStep(
            new NamedStep(
                input: implode($xorOutput),
                output: implode($xorSecondAfterSBox),
                translatedActionName: trans('simpleDesPageTexts.SBoxPermutation', ['boxNumber' => 1]),
                imageUrl: asset('img/simpleDesPage/sBoxes.png')
            )
        );

        $mergedXor = array_merge($xorFirstAfterSBox, $xorSecondAfterSBox);
        $p4 = $this->permutation($mergedXor, self::P4);
        $this->output->addStep(
            new NamedStep(
                input: implode($mergedXor),
                output: implode($p4),
                translatedActionName: trans(
                    'simpleDesPageTexts.P4'
                ),
                imageUrl: asset('img/simpleDesPage/P4.png')
            )
        );

        $xor = $this->xor($leftHalf, $p4);
        $this->output->addStep(
            new NamedStep(
                input: implode($leftHalf) . ' ⊕ ' . implode($p4),
                output: implode($xor),
                translatedActionName: trans('simpleDesPageTexts.xor')
            )
        );

        return $xor;
    }

    /**
     * Simple array swap.
     * Left = Right && Right = Left
     * @param String[] $leftHalf
     * @param String[] $rightHalf
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
     * @throws Exception
     */
    public function encrypt(): SDESOutput
    {
        // Init permutation
        $permutedText = $this->permutation(str_split($this->text), self::IP);
        $this->output->addStep(
            new NamedStep(
                input: $this->text,
                output: implode($permutedText),
                translatedActionName: trans(
                    'simpleDesPageTexts.IP'
                ),
                imageUrl: asset('img/simpleDesPage/IP.png')
            )
        );

        [$leftHalf, $rightHalf] = array_chunk($permutedText, 4);
        $this->output->addStep(
            new NamedStep(
                input: implode($permutedText),
                output: implode($leftHalf) . ' | ' . implode(
                    '',
                    $rightHalf
                ),
                translatedActionName: trans('simpleDesPageTexts.split')
            )
        );

        // Complex function
        $leftHalf = $this->roundFunction($leftHalf, $rightHalf, str_split($this->firstHalfKey));

        // Swap half sides
        /** @var array{array-key, string} $leftHalf */
        [$leftHalf, $rightHalf] = $this->swap($leftHalf, $rightHalf);
        $this->output->addStep(
            new NamedStep(
                input: implode($rightHalf) . ' | ' . implode($leftHalf),
                output: implode(
                    '',
                    $leftHalf
                ) . ' | ' . implode($rightHalf),
                translatedActionName: trans('simpleDesPageTexts.swap'),
            )
        );

        // Perform complex function again but with swapped sides
        $leftHalf = $this->roundFunction($leftHalf, $rightHalf, str_split($this->secondHalfKey));

        // Merge and perform inverse permutation
        $mergedOutputs = array_merge($leftHalf, $rightHalf);
        /** @var array{array-key, string} $mergedOutputs */
        $output = $this->permutation($mergedOutputs, self::IIP);
        $this->output->addStep(
            new NamedStep(
                input: implode($mergedOutputs),
                output: implode($output),
                translatedActionName: trans(
                    'simpleDesPageTexts.IIP'
                ),
                imageUrl: asset('img/simpleDesPage/IIP.png')
            )
        );

        $this->output->setOutputValue(implode($output));

        return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     * @throws Exception
     */
    public function decrypt(): SDESOutput
    {
        // Init permutation
        $permutedText = $this->permutation(str_split($this->text), self::IP);
        $this->output->addStep(
            new NamedStep(
                input: $this->text,
                output: implode($permutedText),
                translatedActionName: trans(
                    'simpleDesPageTexts.IP'
                ),
                imageUrl: asset('img/simpleDesPage/IP.png')
            )
        );

        [$leftHalf, $rightHalf] = array_chunk($permutedText, 4);
        $this->output->addStep(
            new NamedStep(
                input: implode($permutedText),
                output: implode($leftHalf) . ' | ' . implode(
                    '',
                    $rightHalf
                ),
                translatedActionName: trans('simpleDesPageTexts.split')
            )
        );

        // Complex function
        $leftHalf = $this->roundFunction($leftHalf, $rightHalf, str_split($this->secondHalfKey));

        // Swap half sides
        /**
         * @var String[] $leftHalf
         * @var String[] $rightHalf
         */
        [$leftHalf, $rightHalf] = $this->swap($leftHalf, $rightHalf);
        $this->output->addStep(
            new NamedStep(
                input: implode($rightHalf) . ' | ' . implode($leftHalf),
                output: implode($leftHalf) . ' | ' . implode($rightHalf),
                translatedActionName: trans('simpleDesPageTexts.swap'),
                imageUrl: asset('img/simpleDesPage/SW.png')
            )
        );

        // Perform complex function again but with swapped sides
        $leftHalf = $this->roundFunction($leftHalf, $rightHalf, str_split($this->firstHalfKey));

        // Merge and perform inverse permutation
        $mergedOutputs = array_merge($leftHalf, $rightHalf);
        /** @var String[] $mergedOutputs */
        $output = $this->permutation($mergedOutputs, self::IIP);
        $this->output->addStep(
            new NamedStep(
                input: implode($mergedOutputs),
                output: implode($output),
                translatedActionName: trans(
                    'simpleDesPageTexts.IIP'
                ),
                imageUrl: asset('img/simpleDesPage/IIP.png')
            )
        );


        $this->output->setOutputValue(implode($output));
        return $this->output; //return full encrypted text with steps
    }
}
