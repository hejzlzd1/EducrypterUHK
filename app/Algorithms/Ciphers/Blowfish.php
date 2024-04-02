<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\BlowfishRound;
use App\Algorithms\Output\Steps\BlowfishBlockStep;
use Exception;

// 64bit block implementation of ecb blowfish

/**
 * @author hejzlzd1
 */
class Blowfish extends BlockCipher
{
    private array $roundSteps;

    private bool $keysModified = false;

    private BasicOutput $output;

    /**
     * Prepare subkeys and sboxes based on user input key
     *
     * @throws Exception
     */
    public function __construct(string $text, ?string $key, int $operation)
    {
        //init default sboxes and keys
        $this->initSboxes();

        //check key validity and convert to binary array
        if (empty($key)) {
            throw new Exception(__('baseTexts.keyCannotBeEmpty'));
        }
        $hexKeyArray = $this->stringToHexBytes($key);

        if (count($hexKeyArray) < 4 || count($hexKeyArray) > 56) {
            throw new Exception(__('baseTexts.keyLongerThan448'));
        }

        if ($operation === CipherBase::ALGORITHM_DECRYPT) {
            $text = base64_decode($text);
        }

        //start blowfish key schedule -> modify sboxes and generate permuted subkeys
        $this->modifySubkeys($hexKeyArray);
        $this->keysModified = true;
        $this->output = new BasicOutput(inputValue: $text, operation: $operation, key: $key);
        $this->output->addAdditionalInformation(
            [
                'subkeys' => $this->getSubkeys(),
            ]
        );
        parent::__construct($text, $key, $operation);
    }

    /**
     * Blowfish key schedule
     * Function modifies default permuted keys and sboxes depending on key that user filled in
     *
     * @return void
     */
    private function modifySubkeys(array $keyArray)
    {
        $keyString = implode($keyArray);
        $keyParts = str_split($keyString,8);
        $j = 0;
        for ($i = 0; $i < 18; $i++) { // 18 permutation subkeys (modify predefined parr keys with input key)
            if ($j >= count($keyParts)) {
                $j = 0;
            }
            $this->parr[$i] = $this->xorHex($this->parr[$i], $keyParts[$j]);
            $j++;
        }

        //fill input blocks with zeros for padding shorter input key
        $rightBlock = '00000000';
        $leftBlock = '00000000';

        //key and sbox expansion
        for ($i = 0; $i < 18; $i = $i + 2) {
            $lastoutput = $this->rounds($leftBlock, $rightBlock);
            [$this->parr[$i], $this->parr[$i + 1]] = $lastoutput;
        }

        for ($j = 0; $j < 4; $j++) {
            for ($i = 0; $i < 256; $i = $i + 2) {
                $lastoutput = $this->rounds($leftBlock, $rightBlock);
                [$this->sboxes[$j][$i], $this->sboxes[$j][$i + 1]] = $lastoutput;
            }
        };

        $this->subkeys = $this->parr;
    }

    /**
     * @ This functions performs blowfish rounds - 16 in total, parameters are two 32-bit binary strings
     */
    private function rounds($leftBlock, $rightBlock): array
    {
        $this->roundSteps = [];
        for ($i = 0; $i < 16; $i++) {
            $inputLeft = $leftBlock;
            $inputRight = $rightBlock;

            $leftBlock = $this->xorHex($leftBlock, $this->parr[$i]); // XOR left block with permuted key

            $leftBlockAfterXor = $leftBlock;
            $rightBlockAfterFeistel = $this->feistelFunction($leftBlock);

            $rightBlock = $this->xorHex($this->feistelFunction($leftBlock), $rightBlock); // XOR right block with result of Feistel

            $rightBlockAfterXor = $rightBlock;

            [$leftBlock, $rightBlock] = [$rightBlock, $leftBlock]; // swap blocks

            if ($this->keysModified) {
                $this->roundSteps[] =
                    new BlowfishRound(
                        inputLeft: $inputLeft,
                        inputRight: $inputRight,
                        leftBlockAfterXor: $leftBlockAfterXor,
                        rightBlockAfterXor: $rightBlockAfterXor,
                        rightBlockAfterFeistel: $rightBlockAfterFeistel,
                        subkey: $this->parr[$i]
                    );
            }
        }
        //last step
        [$leftBlock, $rightBlock] = [$rightBlock, $leftBlock]; //undo last swap from cycle
        $inputLeft = $leftBlock;
        $inputRight = $rightBlock;

        $rightBlock = $this->xorHex($rightBlock, $this->parr[16]); //xor right block with corresponding subkey
        $leftBlock = $this->xorHex($leftBlock, $this->parr[17]); //xor left block with corresponding subkey

        $rightBlockAfterXor = $rightBlock;
        $leftBlockAfterXor = $leftBlock;

        if ($this->keysModified) {
            $this->roundSteps[] =
                new BlowfishRound(
                    inputLeft: $inputLeft,
                    inputRight: $inputRight,
                    leftBlockAfterXor: $leftBlockAfterXor,
                    rightBlockAfterXor: $rightBlockAfterXor,
                    rightBlockAfterFeistel: $rightBlockAfterFeistel,
                    subkey: $this->parr[$i]
                );
            $this->output->addAdditionalInformation(
                [
                    'subkey17' => $this->parr[16],
                    'subkey18' => $this->parr[17],
                ]
            );
        }

        return [$leftBlock, $rightBlock]; //return two encrypted blocks
    }

    /**
     * Public function to encrypt plain string
     */
    public function encrypt(): BasicOutput
    {
        $this->output->addAdditionalInformation(
            [
                'inputSize' => strlen($this->text) * 8,
            ]
        ); //set bit length of input for visualisation
        $cipherText = ''; //init variable for ciphered text
        $chunks = implode(array_merge($this->stringToHexBytes($this->text)));
        $blocks = str_split($chunks, 16);

        foreach ($blocks as $block) { //for each 64 bit chunk
            $halfBlocks = str_split($block, 8);
            $blockStep = new BlowfishBlockStep();

            if (!isset($halfBlocks[1])) {
                $halfBlocks[1] = str_pad('', 8, '0', STR_PAD_LEFT);
            } //if second 32bit chunk is not present fill it with 0 to make sure function works

            $encryptedChunk = $this->encryptChunk([$halfBlocks[0], $halfBlocks[1]]); //encrypt 64bit by blowfish chunk
            $cipherText .= $encryptedChunk[0] . $encryptedChunk[1];
            $blockStep->setOutputValue($encryptedChunk[0] . $encryptedChunk[1]);
            $blockStep->setRounds($this->roundSteps);
            $this->output->addStep($blockStep);
        }

        $this->output->setOutputValue($cipherText);

        return $this->output; //return full encrypted text with steps
    }

    /**
     * Public function to decrypt text
     */
    public function decrypt(): BasicOutput
    {
        /*
        $this->output->addAdditionalInformation(
            [
                'inputSize' => strlen($this->text) * 8,
            ]
        ); //set bit length of input for visualisation
        $chunks = $this->stringToWordArray($this->text); //get 32bit blocks array
        $chunks = array_chunk($chunks, 2); //make 64bit chunks
        $plainText = '';

        foreach ($chunks as $chunk) { //repeat for all chunks
            if (count($chunk) == 1) {
                $chunk[1] = 0;
            } //if second 32bit chunk is not present fill it with 0 to make sure function works
            $blockStep = new BlowfishBlockStep();
            $deciphered = $this->decryptChunk($chunk); //decipher whole chunk
            $blockText = $this->wordArrayToString($deciphered); //get text value of decryption
            $plainText .= $this->wordArrayToString($deciphered);
            $blockStep->setOutputValue($blockText);
            $blockStep->setRounds($this->roundSteps);
            $this->output->addStep($blockStep);
        }

        $this->output->setOutputValue($plainText);
        */
        return $this->output; //return output class
    }

    /**
     * Function receives 64bit chunk (array - containing 2x 32bit blocks)
     * Input blocks to blowfish cipher and return two encrypted blocks
     */
    private function encryptChunk($chunk): array
    {
        return $this->rounds($chunk[0], $chunk[1]);
    }

    /**
     * Function receives 64bit chunk (array - containing 2x 32bit blocks)
     * 1. First reverse permuted keys
     * 2. Input blocks to blowfish cipher and return two decrypted blocks
     * 3. Undo reversion of keys
     */
    private function decryptChunk(array $chunk): array
    {
        $this->parr = array_reverse($this->parr);
        $plainBlock = $this->rounds($chunk[0], $chunk[1]);
        $this->parr = array_reverse($this->parr);

        return $plainBlock;
    }
}
