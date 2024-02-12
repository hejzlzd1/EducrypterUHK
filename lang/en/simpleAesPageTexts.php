<?php

return [
    'title' => 'Crypto application - Simplified AES',
    'annotation' => 'Simplified AES (Advanced Encryption Standard) is a simplified version of the AES algorithm designed for educational purposes. The AES algorithm is a widely used symmetric encryption standard that is adopted by the United States government and commonly used around the world to encrypt sensitive data.
        Smaller block and key sizes (16-bit) are usually used in simplified AES compared to the full version of AES (128, 192 or 256 bits). It also involves fewer rounds - ie substitutions, swapping matrix rows, combining columns.
        <br /><br />
        The generation of round keys takes place using several operations. The main operations performed include bitwise XOR, bit substitution using s-box values or shuffling of bit strings. The results of the operations are then combined to form round keys.
        <br /><br />
        In the initial round, the input text is combined with the initial key of the round using a simple XOR operation. The following are the main rounds of the algorithm 1x for S-AES, for AES its depending on length of key. It can occur 9x, 11x or 13x times, which usually include a sequence of substitution operations, swapping matrix rows and combining columns (skipped in the last round - the procedure can be found under the term " Rijndael MixColumns"). In simplified AES, these operations are greatly simplified to make them easier to understand and implement. Compared to the original AES algorithm, operations are performed on a smaller data input, which greatly simplifies the algorithm\'s progress.
        At the end of each round, the data output is combined with the round key using an XOR operation.
        <br /><br />
        Decryption in Simplified AES involves reversing the encryption steps. This also applies to the use of round keys - i.e. round keys are used in reverse order K2 -> K1 -> K0
        <br />
        It is important to note that simplified AES is primarily used for educational purposes to understand the basic principles of the AES algorithm. In real deployment, it is necessary to use non-simplified alternatives with a sufficient bit key length as part of security.
    ',
    'metaComment' => 'This page contains information on the simplified version of AES and the test form',
    'additionalSchemas' => 'Supplementary schemes',
    'blockSchema' => 'Block diagram',
    'binaryInput' => 'Binary input (16 bits)',
    'binaryKey' => 'Binary key (16 bits)',
    'keyGeneration' => 'Generating round keys',
    'addRoundKey' => 'Saving the key',
    'splitKey' => 'Splitting the inputted key into two parts (8 bits)',
    'rotateKey' => 'Swapping key parts',
    'substituteNibbles' => '4-bit replacement using s-box',
    'shiftRow' => 'Swapping S₀₁ with S₁₁',
    'encryptMixNibbles' => 'Multiply (S₀₀, S₀₁, S₁₀, S₁₁) by (1, 4, 4, 1) - Galois multiplication',
    'decryptMixNibbles' => 'Multiply (S₀₀, S₀₁, S₁₀, S₁₁) by (9, 2, 2, 9) - Galois multiplication'
];
