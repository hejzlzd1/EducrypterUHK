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
        ['1001', '0100', '1010', '1011'],
        ['1101', '0001', '1000', '0101'],
        ['0110', '0010', '0000', '0011'],
        ['1100', '1111', '1110', '0111']
    ];

    private $sBoxInverse = [
        ['1010', '0101', '1001', '1011'],
        ['0001', '0111', '1000', '1111'],
        ['0110', '0000', '0010', '0011'],
        ['1100', '0100', '1101', '1110']
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

    private function generateRoundKeys($key) {
        $roundKeys = [];

        /*
        $w0 = str_split();
        $w1 = str_split();
        */

        return $roundKeys;
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
