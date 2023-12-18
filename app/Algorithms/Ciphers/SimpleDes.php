<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use Exception;

/**
 * Implementation of SimpleDES algorithm
 * @author hejzlzd1
 */
class SimpleDes extends BlockCipher
{

    private BasicOutput $output;
    private string $firstHalfKey;
    private string $secondHalfKey;

    /**
     * Prepare subkeys
     * @param string $text
     * @param string $key
     * @param int $operation
     */
    public function __construct(string $text, string $key, int $operation)
    {
        if (mb_strlen($key) < 10) {
            $key = str_pad($key,10, 0, STR_PAD_LEFT);
        }
        if (mb_strlen($text) < 8) {
            $text = str_pad($text,8, 0, STR_PAD_LEFT);
        }
        $this->keyGeneration($key);
        parent::__construct($text, $key, $operation);
    }

    public function keyGeneration(string $key): void
    {
        // TODO finish this method
        // https://www.geeksforgeeks.org/simplified-data-encryption-standard-key-generation/
    }

    public function permutationP10(array $binary): array
    {
        // TODO finish this method
        // https://www.geeksforgeeks.org/simplified-data-encryption-standard-key-generation/
        return [];
    }


    /**
     * Public function to encrypt plain string
     * @return BasicOutput
     */
    public function encrypt(): BasicOutput
    {
        return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     * @return BasicOutput
     */
    public function decrypt(): BasicOutput
    {
        return $this->output; //return output class
    }
}

