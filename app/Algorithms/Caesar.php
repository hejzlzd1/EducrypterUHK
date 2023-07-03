<?php

namespace App\Algorithms;

class Caesar extends Base implements BaseAlgorithm
{
    private int $shift;

    /**
     * Normalize input string to basic chars and set shifts
     * @param int $shift
     */
    public function __construct(string $text,int $shift,int $operation) {
        $this->shift = $shift;
        parent::__construct($this->normalize($text),null, $operation);
    }

    /**
     * Performs selected operation from form
     * @return string|array
     */
    public function performOperation(): string|array
    {
        switch ($this->operation) {
            case Base::DECRYPT:
                return $this->decrypt();
            case Base::ENCRYPT:
                return $this->encrypt();
            default:
                return $this->bruteForce();
        }
    }

    /**
     * Get rotated alphabet
     * @return array
     */
    public function rotateAlphabet(): array
    {
        $alphabet = [];
        foreach (range("A","Z") as $char){
            $alphabet[] = $char;
        }
        for ($i = 0; $i < $this->shift; $i++) {
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
            $bruteForceResults[] = $this->decrypt();
        }
        return $bruteForceResults;
    }

    /**
     * Encryption by moving each char by shift, decryption by moving back
     * @return string
     */
    public function decrypt()
    {
        $result = "";

        $shift = 26-$this->shift;

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

    public function encrypt()
    {
        $result = "";

        // traverse text
        for ($i = 0; $i < strlen($this->text); $i++)
        {
            if($this->text[$i] != " "){
                // apply transformation to each
                // character Encrypt Uppercase letters
                if (ctype_upper($this->text[$i]))
                    $result = $result.chr((ord($this->text[$i]) +
                                $this->shift - 65) % 26 + 65);

                // Encrypt Lowercase letters
                else
                    $result = $result.chr((ord($this->text[$i]) +
                                $this->shift - 97) % 26 + 97);
            }else{
                $result = $result.chr(32);
            }
        }

        // Return the resulting string
        return $result;
    }
}
