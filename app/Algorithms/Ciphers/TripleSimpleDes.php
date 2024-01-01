<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\BlockCipher;
use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\SDESOutput;
use App\Algorithms\Output\Steps\NamedStep;
use App\Algorithms\Output\TSDESOutput;
use Exception;

/**
 * Implementation of TripleDES based on simple des algorithm (for easier edu demonstrations)
 *
 * @author hejzlzd1
 */
class TripleSimpleDes
{
    private TSDESOutput $output;

    public function __construct(private string $text, private string $key, private string $key2, private int $operation)
    {
        $this->output = new TSDESOutput($this->text, $this->operation, $this->key, $key2);
    }

    public function decrypt(): TSDESOutput
   {
       // Decrypt, encrypt, decrypt (key1 === key3)
       $decryption = new SimpleDes($this->text, $this->key, CipherBase::ALGORITHM_DECRYPT);
       $result = $decryption->decrypt();

       $decryptedBinary = $result->getOutputValue();
       $this->output->addDesStep($result);

       $encryption = new SimpleDes($decryptedBinary, $this->key2, CipherBase::ALGORITHM_ENCRYPT);
       $result = $encryption->encrypt();

       $encryptedBinary = $result->getOutputValue();
       $this->output->addDesStep($result);

       $decryptedBinary = new SimpleDes($encryptedBinary, $this->key, CipherBase::ALGORITHM_DECRYPT);
       $result = $decryptedBinary->decrypt();

       $this->output->addDesStep($result);
       $this->output->setOutputValue($result->getOutputValue());
       return $this->output;
   }

   public function encrypt(): TSDESOutput
   {
       // Encrypt, decrypt, encrypt (key1 === key3)
       $encryption = new SimpleDes($this->text, $this->key, CipherBase::ALGORITHM_ENCRYPT);
       $result = $encryption->encrypt();

       $encryptedBinary = $result->getOutputValue();
       $this->output->addDesStep($result);

       $decryption = new SimpleDes($encryptedBinary, $this->key2, CipherBase::ALGORITHM_DECRYPT);
       $result = $decryption->decrypt();

       $decryptedBinary = $result->getOutputValue();
       $this->output->addDesStep($result);

       $encryption = new SimpleDes($decryptedBinary, $this->key, CipherBase::ALGORITHM_ENCRYPT);
       $result = $encryption->encrypt();

       $this->output->addDesStep($result);
       $this->output->setOutputValue($result->getOutputValue());
       return $this->output;
   }

    public function getOperation(): int
    {
        return $this->operation;
    }
}
