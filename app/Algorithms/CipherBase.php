<?php

namespace App\Algorithms;

use App\Algorithms\Output\BasicOutput;

abstract class CipherBase
{
    public const ALGORITHM_ENCRYPT = 1;
    public const ALGORITHM_DECRYPT = 0;
    public const ALGORITHM_DECRYPT_BRUTEFORCE = 2;

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

    public function getStringAlgorithmOperation(int $operation): string
    {
        return match ($operation){
            self::ALGORITHM_ENCRYPT => 'encrypt',
            self::ALGORITHM_DECRYPT => 'decrypt',
            self::ALGORITHM_DECRYPT_BRUTEFORCE => 'bruteforce',
        };
    }

    public static function normalize($string): string
    {
        $table = array(
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ě' => 'e', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
        );

        return strtr($string, $table);
    }

    /**
     * Format key to match size of text
     * @param string $key
     * @param int $length
     * @return string
     */
    public function resizeKey(string $key, int $length)
    {
        $keyLen = strlen($key);
        for ($i = 0; $i < $keyLen; ++$i) {
            if (!ctype_alpha($key[$i]))
                return ""; // Error
        }
        if (strlen($key) >= $length) $key = substr($key, 0, $length);
        return str_pad($key, $length, $key);
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getOperation(): int
    {
        return $this->operation;
    }

    /**
     * @param int $operation
     */
    public function setOperation(int $operation): void
    {
        $this->operation = $operation;
    }

    public function getAsciiFromString(string $input): string {
        $asciiValues = [];
        for ($i = 0; $i < strlen($input); $i++) {
            $asciiValues[] = ord($input[$i]) . '|';
        }
        return implode('', $asciiValues);
    }
}
