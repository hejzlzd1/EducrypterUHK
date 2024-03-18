<?php

return [
    'title' => 'EduCrypter - Simplified AES',
'annotation' => 'Simplified AES (S-AES) is a simplified version of the Advanced Encryption Standard (AES). Designed for educational purposes, it provides a clear and easy-to-understand overview of the basics of block ciphers and a simplified view of the original AES. The AES algorithm is a widely used symmetric encryption standard that is adopted by the United States government and commonly used around the world to encrypt sensitive data.
        Smaller block and key sizes (16-bit) are usually used in simplified AES compared to the full version of AES (128, 192 or 256 bits). It also involves fewer rounds, which means fewer substitutions, swapping matrix rows, and combining columns.
        ',
    'keyGenerationTitle' => 'Key generation',
    'keyGenerationInfo' => '
        The generation of round keys takes place using several operations. The main operations performed include bitwise XOR, bit substitution using values in S-boxes or shuffling of bit strings. The results of the operations are then combined to form round keys.
    ',
    'encryptionTitle' => 'Encryption',
    'encryption' => '
        In the initial round, the input text is combined with the initial key of the round using a simple XOR operation. Following are the main rounds of Algorithm 1x in S-AES. In AES, this round is repeated 9x, 11x or 13x (depending on the length of the key). These round functions include sequence substitutions, swapping matrix rows, and combining columns. The mixColumns operation (Reindel\'s MixColumns function) is a transformation operation that consists of multiplication in a Galois field, addition of a constant byte, and a bitwise operation and permutation. Combining columns is skipped in the last round. In Simplified AES, these operations are greatly simplified to make them easier to understand and implement. The simplification consists in removing the constant byte and omitting bitwise operations and permutations. Compared to the original AES algorithm, operations are performed on a smaller data input, which greatly simplifies the algorithm\'s progress.
        At the end of each round, the data output is combined with the round key using an XOR operation.
    ',
    'decryptionTitle' => 'Decryption',
    'decryption' => '
        Decryption in AES and S-AES involves reversing the encryption steps. In this case round keys are used in reverse order K2 -> K1 -> K0.
    ',
    'disclaimerTitle' => 'Disclaimer',
    'disclaimer' => '
        It is important to note that simplified AES is primarily used for educational purposes to understand the basic principles of the AES algorithm. In real deployment, non-simplified AES with sufficient bit key length needs to be used.
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
    'substituteNibbles' => '4-bit replacement using S-box',
    'inverseSubstituteNibbles' => '4-bit replacement using inverse S-box',
    'shiftRow' => 'Swapping S₀₁ with S₁₁',
    'encryptMixNibbles' => 'Multiply (S₀₀, S₀₁, S₁₀, S₁₁) by (1, 4, 4, 1) - Galois multiplication',
    'decryptMixNibbles' => 'Multiply (S₀₀, S₀₁, S₁₀, S₁₁) by (9, 2, 2, 9) - Galois multiplication',
    'startOfRound' => 'Start of the round',
    'endOfRound' => 'End of the round',
    'sbox' => 'S-box',
    'sboxInverse' => 'S-box⁻¹',
];
