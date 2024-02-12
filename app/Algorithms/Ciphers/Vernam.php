<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;

use Exception;

class Vernam extends CipherBase
{
    public function __construct(string $text, string $key, int $operation)
    {
        $textSize = mb_strlen($text);
        $keySize = mb_strlen($key);
        if ($keySize > $textSize) {
            $textSize = $keySize - $textSize;
            $key = substr($key, $textSize, $keySize);
        } elseif ($keySize < $textSize) {
            $key = str_pad($key, $textSize, 0, STR_PAD_LEFT);
        }
        parent::__construct($text, $key, $operation);
    }

    /**
     * @throws Exception
     */
    public function encrypt(): BasicOutput|string
    {
        $output = new BasicOutput(inputValue: $this->text, operation: $this->operation, key: $this->key);
        $xor = $this->xor(firstInput: str_split($this->text), secondInput: str_split($this->key), returnSteps: true);
        $output->setOutputValue(implode('', $xor['output']));
        $output->setSteps($xor['steps']);
        return $output;
    }

    /**
     * @throws Exception
     */
    public function decrypt(): BasicOutput|string
    {
        return $this->encrypt();
    }
}
