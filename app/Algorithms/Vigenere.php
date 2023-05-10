<?php

namespace App\Algorithms;

class Vigenere
{
    /**
     * @var string
     */
    private string $text;

    private string $key;

    /**
     * Normalize input string to basic chars
     * @param $text
     */
    public function __construct($text,$key) {
        $this->text = $this->normalize($text);
        $this->key = $this->formatKey($key);
    }

    /**
     * Normalize text before using it
     * @param $string
     * @return string
     */
    private function normalize($string): string
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
     * Modulo function for vigenere
     * @param $a
     * @param $b
     * @return int
     */
    private function Mod($a, $b): int
    {
        return ($a % $b + $b) % $b;
    }

    /**
     * @param $mode
     * Values:
     * Decrypt = false
     * Encrypt = true
     * @return string
     */
    public function perform($mode): string
    {
        $keyLen = strlen($this->key); //length of key

        for ($i = 0; $i < $keyLen; ++$i)
            if (!ctype_alpha($this->key[$i]))
                return ""; // found non char in key

        $output = "";
        $nonAlphaCharCount = 0;
        $inputLen = strlen($this->text); //length of input

        for ($i = 0; $i < $inputLen; ++$i) {
            if (ctype_alpha($this->text[$i])) { //is char at index?
                $cIsUpper = ctype_upper($this->text[$i]); //is upper char?
                $offset = ord($cIsUpper ? 'A' : 'a'); // convert to ascii
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen; // get key index depending on key
                $k = ord($cIsUpper ? strtoupper($this->key[$keyIndex]) : strtolower($this->key[$keyIndex])) - $offset; //get char
                $k = $mode ? $k : -$k; //if decrypt do function reverse way
                $ch = chr(($this->mod(((ord($this->text[$i]) + $k) - $offset), 26)) + $offset); //get new char
                $output .= $ch;
            } else {
                $output .= $this->text[$i];
                ++$nonAlphaCharCount;
            }
        }

        return $output;
    }

    /**
     * Format key to match size of text
     * @param $key
     * @return string
     */
    private function formatKey($key)
    {
        $keyLen = strlen($key);
        for ($i = 0; $i < $keyLen; ++$i) {
            if (!ctype_alpha($key[$i]))
                return ""; // Error
        }
        if (strlen($key) >= strlen($this->text)) $key = substr($key, 0, strlen($this->text));
        return str_pad($key, strlen($this->text), $key);
    }

    /**
     * @return string
     */
    public function getFormatedKey(): string
    {
        return $this->key;
    }
}
