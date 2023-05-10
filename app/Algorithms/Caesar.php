<?php

namespace App\Algorithms;

class Caesar
{
    /**
     * @var string
     */
    private string $text = "";

    /**
     * Normalize input string to basic chars
     * @param $text
     */
    public function __construct($text) {
        $this->text = $this->normalize($text);
    }

    /**
     * Get rotated alphabet
     * @param $key
     * @return array
     */
    public function rotateAlphabet($key): array
    {
        $alphabet = [];
        foreach (range("A","Z") as $char){
            $alphabet[] = $char;
        }
        for ($i = 0; $i < $key; $i++) {
            $temp = array_shift($alphabet);
            $alphabet[] = $temp;
        }
        return $alphabet;
    }

    /**
     * Show all 26 results of decryption, try moving alphabet 26 times
     * @return array
     */
    public function bruteForce(): array
    {
        $bruteForceResults = [];
        for($i = 0; $i < 26; $i++){
            $bruteForceResults[] = $this->performCaesar($i, "decrypt");
        }
        return $bruteForceResults;
    }

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
     * Encryption by moving each char by shift, decryption by moving back
     * @param $shift
     * @param $type
     * @return string
     */
    public function performCaesar($shift,$type): string
    {
        $result = "";

        if($type =="decrypt") $shift = 26-$shift;

        // traverse text
        for ($i = 0; $i < strlen($this->text); $i++)
        {
            if($this->text[$i] != " "){
                // apply transformation to each
                // character Encrypt Uppercase letters
                if (ctype_upper($this->text[$i]))
                    $result = $result.chr((ord($this->text[$i]) +
                                $shift - 65) % 26 + 65);

                // Encrypt Lowercase letters
                else
                    $result = $result.chr((ord($this->text[$i]) +
                                $shift - 97) % 26 + 97);
            }else{
                $result = $result.chr(32);
            }
        }

        // Return the resulting string
        return $result;
    }
}
