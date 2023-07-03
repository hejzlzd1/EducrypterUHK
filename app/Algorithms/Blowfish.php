<?php

namespace App\Algorithms;

use Exception;

// 64bit block implementation of ecb blowfish

/**
 * @author hejzlzd1
 */
class Blowfish extends Base implements BaseAlgorithm {

    private array $roundSteps;

    private bool $keysModified = false;

    /**
     * Array that saves additional info in algorithm - serves only for visualisation in templates
     * @var array
     */
    private array $stepsOfAlgorithm;
    /**
     * Value that stores length of input from user - serves only for visualisation in templates
     * @var int
     */
    private int $inputSize;

    /**
     * Prepare subkeys and sboxes based on user input key
     * @param $key
     * @throws Exception
     */
    public function __construct($key) {
        //init default sboxes and keys
        $this->initDefaultKeys();

        //check key validity and convert to binary array
        if(empty($key)) throw new Exception("Key cannot be empty!");
        $keyArray = $this->stringToWordArray($key);
        if(count($keyArray) > 14) throw new Exception("Key cannot be longer than 448-bits");

        //start blowfish key schedule -> modify sboxes and generate permuted subkeys
        $this->modifySubkeys($keyArray);
        $this->keysModified = true;
    }

    /**
     * Blowfish key schedule
     * Function modifies default permuted keys and sboxes depending on key that user filled in
     * @param array $keyArray
     * @return void
     */
    private function modifySubkeys(array $keyArray){
        for($i = 0; $i < 18; ++$i) // 18 permutation subkeys (modify predefined parr keys with input key)
            $this->parr[$i] ^= $keyArray[$i % count($keyArray)];

        //fill input blocks with zeros for padding shorter input key
        $rightBlock = 0x00000000;
        $leftBlock = 0x00000000;

        //key and sbox expansion
        for($i = 0; $i < 9; ++$i) {
            $lastoutput = $this->rounds($leftBlock,$rightBlock);
            list($this->parr[2*$i], $this->parr[2*$i+1]) = $lastoutput;
        }

        for ($j = 0; $j < 4; ++$j)
            for($i = 0; $i < 128; ++$i) {
                $lastoutput = $this->rounds($leftBlock,$rightBlock);
                list($this->sboxes[$j][2*$i], $this->sboxes[$j][2*$i+1]) = $lastoutput;
            }
        $this->subkeys = $this->parr;

    }

    /**
     * @ This functions performs blowfish rounds - 16 in total, parameters are two 32-bit binary strings
     * @param $leftBlock
     * @param $rightBlock
     * @return array
     */
    private function rounds($leftBlock, $rightBlock): array
    {
        $this->roundSteps = array();
        for($i = 0 ; $i < 16; ++$i){
            $inputLeft = $leftBlock;
            $inputRight = $rightBlock;

            $leftBlock = $leftBlock ^ $this->parr[$i]; // XOR left block with permuted key

            $leftBlockAfterXor = $leftBlock;
            $rightBlockAfterFeistel = $this->feistelFunction($leftBlock);

            $rightBlock = $this->feistelFunction($leftBlock) ^ $rightBlock; // XOR right block with result of Feistel

            $rightBlockAfterXor = $rightBlock;

            list($leftBlock, $rightBlock) = array($rightBlock, $leftBlock); // swap blocks

            if($this->keysModified){
            $this->roundSteps[] = array(
                "inputLeft" => base64_encode($inputLeft),
                "inputRight" => base64_encode($inputRight),
                "leftBlockAfterXor" => base64_encode($leftBlockAfterXor),
                "rightBlockAfterXor" => base64_encode($rightBlockAfterXor),
                "rightBlockAfterFeistel" => base64_encode($rightBlockAfterFeistel),
                "subkey" => base64_encode($this->parr[$i])
            ); //make string output of blocks with according subkey value
            }
        }
        //last step
        list($leftBlock, $rightBlock) = array($rightBlock, $leftBlock); //undo last swap from cycle

        $inputLeft = $leftBlock;
        $inputRight = $rightBlock;

        $rightBlock = $rightBlock ^ $this->parr[16]; //xor right block with corresponding subkey
        $leftBlock = $leftBlock ^ $this->parr[17]; //xor left block with corresponding subkey

        $rightBlockAfterXor = $rightBlock;
        $leftBlockAfterXor = $leftBlock;

        if($this->keysModified){
            $this->roundSteps[] = array(
                "inputLeft" => base64_encode($inputLeft),
                "inputRight" => base64_encode($inputRight),
                "leftBlockAfterXor" => base64_encode($leftBlockAfterXor),
                "rightBlockAfterXor" => base64_encode($rightBlockAfterXor),
                "subkey17" => base64_encode($this->parr[16]),
                "subkey18" => base64_encode($this->parr[17])
            ); //make string output of blocks with according subkey value
        }

        return array($leftBlock,$rightBlock); //return two encrypted blocks
    }

    /**
     * Public function to encrypt plain string
     * @param String $plaintext
     * @return string
     */
    public function encrypt(String $plaintext):string{
        $this->inputSize = strlen($plaintext) * 8; //set bit length of input for visualisation
        $cipherText = ""; //init variable for ciphered text
        $chunks = array_chunk($this->stringToWordArray($plaintext),2); //create arrays that contain 2x 32bit blocks
        $this->stepsOfAlgorithm = array(); //init variable for stepping algorithm

        foreach ($chunks as $chunk){ //for each 64 bit chunk
            if (count($chunk) == 1) $chunk[1] = 0; //if second 32bit chunk is not present fill it with 0 to make sure function works
            $encryptedChunk = $this->encryptChunk($chunk); //encrypt 64bit by blowfish chunk
            $blockText = $this->wordArrayToString($encryptedChunk); //get text value of encryption
            $cipherText .= $this->wordArrayToString($encryptedChunk);
            $this->stepsOfAlgorithm[] = array("roundSteps" => $this->roundSteps, "blockFinalString" => base64_encode($blockText)); //make output for visualisation
        }
        return $cipherText; //return full encrypted text
    }

    /**
     * Public function to decrypt text
     * @param String $cipherText
     * @return string
     */
    public function decrypt(String $cipherText):string{
        $this->inputSize = strlen($cipherText) * 8; //set bit length of input for visualisation
        $chunks = $this->stringToWordArray($cipherText); //get 32bit blocks array
        $chunks = array_chunk($chunks,2); //make 64bit chunks
        $plainText = "";
        $this->stepsOfAlgorithm = array(); //init variable for stepping algorithm

        foreach($chunks as $chunk){ //repeat for all chunks
            $deciphered = $this->decryptChunk($chunk); //decipher whole chunk
            $blockText = $this->wordArrayToString($deciphered); //get text value of decryption
            $plainText .= $this->wordArrayToString($deciphered);
            $this->stepsOfAlgorithm[] = array("roundSteps" => $this->roundSteps,"blockFinalString" => $blockText); //make output for visualisation
        }
        return $plainText; //return full plain text
    }

    /**
     * Function receives 64bit chunk (array - containing 2x 32bit blocks)
     * Input blocks to blowfish cipher and return two encrypted blocks
     * @param $chunk
     * @return array
     */
    private function encryptChunk($chunk): array
    {
        return $this->rounds($chunk[0],$chunk[1]);
    }

    /**
     * Function receives 64bit chunk (array - containing 2x 32bit blocks)
     * 1. First reverse permuted keys
     * 2. Input blocks to blowfish cipher and return two decrypted blocks
     * 3. Undo reversion of keys
     * @param $chunk
     * @return array
     */
    private function decryptChunk($chunk): array
    {
        $this->parr = array_reverse($this->parr);
        $plainBlock = $this->rounds($chunk[0],$chunk[1]);
        $this->parr = array_reverse($this->parr);

        return $plainBlock;
    }

    /**
     * @return array
     */
    public function getSubkeys(): array
    {
        return $this->subkeys;
    }

    /**
     * @return array
     */
    public function getStepsOfAlgorithm(): array
    {
        return $this->stepsOfAlgorithm;
    }

    /**
     * @return int
     */
    public function getInputSize(): int
    {
        return $this->inputSize;
    }

}

