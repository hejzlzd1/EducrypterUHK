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
class TripleSimpleDes extends CipherBase
{
    private TSDESOutput $output;

    public function __construct(
        protected string $text,
        protected ?string $key,
        private readonly string $key2,
        private readonly string $key3,
        protected int $operation
    )
    {
        $key = $this->expandOrTrimToSpecificBits($key, 10);
        $key2 = $this->expandOrTrimToSpecificBits($key2, 10);
        $key3 = $this->expandOrTrimToSpecificBits($key3, 10);
        $text = $this->expandOrTrimToSpecificBits($text, 8);

        $this->output = new TSDESOutput(inputValue: $text, operation: $operation, key: $key, key2: $key2, key3: $key3);
    }

    public function decrypt(): TSDESOutput
    {
        // Decrypt, encrypt, decrypt
        $decryption = new SimpleDes($this->text, $this->key, CipherBase::ALGORITHM_DECRYPT);
        $result = $decryption->decrypt();

        $decryptedBinary = $result->getOutputValue();
        $this->output->addDesStep($result);

        $encryption = new SimpleDes($decryptedBinary, $this->key2, CipherBase::ALGORITHM_ENCRYPT);
        $result = $encryption->encrypt();

        $encryptedBinary = $result->getOutputValue();
        $this->output->addDesStep($result);

        $decryptedBinary = new SimpleDes($encryptedBinary, $this->key3, CipherBase::ALGORITHM_DECRYPT);
        $result = $decryptedBinary->decrypt();

        $this->output->addDesStep($result);
        $this->output->setOutputValue($result->getOutputValue());
        return $this->output;
    }

    public function encrypt(): TSDESOutput
    {
        // Encrypt, decrypt, encrypt
        $encryption = new SimpleDes($this->text, $this->key, CipherBase::ALGORITHM_ENCRYPT);
        $result = $encryption->encrypt();

        $encryptedBinary = $result->getOutputValue();
        $this->output->addDesStep($result);

        $decryption = new SimpleDes($encryptedBinary, $this->key2, CipherBase::ALGORITHM_DECRYPT);
        $result = $decryption->decrypt();

        $decryptedBinary = $result->getOutputValue();
        $this->output->addDesStep($result);

        $encryption = new SimpleDes($decryptedBinary, $this->key3, CipherBase::ALGORITHM_ENCRYPT);
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
