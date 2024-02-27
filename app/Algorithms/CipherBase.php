<?php

namespace App\Algorithms;

use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\Steps\Step;
use Exception;

abstract class CipherBase
{
    public const int ALGORITHM_ENCRYPT = 1,
    ALGORITHM_DECRYPT = 0,
    ALGORITHM_DECRYPT_BRUTEFORCE = 2;

    protected ?string $key;

    protected string $text;

    protected int $operation;

    public function __construct(string $text, ?string $key, int $operation)
    {
        $this->operation = $operation;
        $this->text = $text;
        $this->key = $key;
    }

    public function encrypt(): BasicOutput|string
    {
        return redirect()->back()->with('alert-info', trans('baseTexts.nonImplementedMethod'));
    }

    public function decrypt(): BasicOutput|string
    {
        return redirect()->back()->with('alert-info', trans('baseTexts.nonImplementedMethod'));
    }

    public function bruteforce(): BasicOutput|string|array
    {
        return redirect()->back()->with('alert-info', trans('baseTexts.nonImplementedMethod'));
    }

    public static function getStringAlgorithmOperation(int $operation): string
    {
        $translatedOperation = match ($operation) {
            self::ALGORITHM_ENCRYPT => trans('baseTexts.encryption'),
            self::ALGORITHM_DECRYPT => trans('baseTexts.decryption'),
            self::ALGORITHM_DECRYPT_BRUTEFORCE => trans('baseTexts.bruteforce'),
        };
        return (string) $translatedOperation;
    }

    public static function normalize($string): string
    {
        $table = [
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ě' => 'e',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
        ];

        return strtr($string, $table);
    }

    /**
     * Format key to match size of text
     *
     * @return string
     */
    public function resizeKey(string $key, int $length)
    {
        $keyLen = strlen($key);
        for ($i = 0; $i < $keyLen; $i++) {
            if (!ctype_alpha($key[$i])) {
                return '';
            } // Error
        }
        if (strlen($key) >= $length) {
            $key = substr($key, 0, $length);
        }

        return str_pad($key, $length, $key);
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getOperation(): int
    {
        return $this->operation;
    }

    public function setOperation(int $operation): void
    {
        $this->operation = $operation;
    }

    public function getAsciiFromString(string $input): string
    {
        $asciiValues = [];
        for ($i = 0; $i < strlen($input); $i++) {
            $asciiValues[] = ord($input[$i]) . ($i !== strlen($input) - 1 ? ' ' : '');
        }

        return implode($asciiValues);
    }

    /**
     * Takes two binary arrays and performs XOR between them
     * @param String[] $firstInput
     * @param String[] $secondInput
     * @return String[] | array{output: String[], steps: array<Step>}
     * @throws Exception
     */
    protected function xor(array $firstInput, array $secondInput, bool $returnSteps = false): array
    {
        if (count($firstInput) !== count($secondInput)) {
            throw new Exception(trans('Cannot xor two different sized inputs'));
        }
        $steps = [];
        $output = [];
        foreach ($firstInput as $index => $binaryValue) {
            $output[] = $binaryValue === $secondInput[$index] ? '0' : '1';
            if ($returnSteps) {
                $steps[] = new Step($binaryValue, $output[$index]);
            }
        }

        if ($returnSteps) {
            return ['output' => $output, 'steps' => $steps];
        }

        return $output;
    }

    /** $data (binary string), $size -> requiredSize*/
    protected function expandOrTrimToSpecificBits(string $data, int $size): string
    {
        $dataLength = mb_strlen($data);
        if ($dataLength < $size) {
            // If data is shorter, pad with zeros
            $data = str_pad($data, $size, '0', STR_PAD_LEFT);
        } elseif ($dataLength > $size) {
            // If data is longer, truncate to x bits
            $data = strrev(mb_substr(strrev($data), 0, $size));
        }

        return $data;
    }
}
