<?php

return [
    'title' => 'Educrypter - Simple DES',
    'metaComment' => 'This page contains a description and test form of the Simple DES cipher',
    'annotation' => '
       Simple DES (S-DES) is a simplified version of the classic Data Encryption Standard (DES) algorithm. It was designed for educational purposes and provides a clear and easy way to understand the basics of block cipher. It also provides simplified point of view for original DES algorithm. This algorithm is not intended for real application as it can be easily broken due to the short key length.<br /> <br />
       The process of S-DES is divided into several parts, which are described below.
    ',
    'keyGenerationInfoTitle' => 'Key generation',
    'keyGenerationInfo' => '
        For the input key (10-bit sequence), the number of characters is validated in the first stage. If the key is too long, it is shortened, otherwise if the key is smaller than plain text it is padded with zeros from the left. <br />
        Then this verified key goes through permutations and shift registers. In the first part, the key goes through the P10 permutation. Its output is divided into two blocks (5-bits each) over which the register is shifted to the left (1x). <br />
        The shifted 5-bit sequences enter the P8 permutation. The output of the P8 permutation is the first 8-bit key. The output from the shift registers is processed by two more shifts. In total, the shift is performed 4 times (2 times for each half of the 5-bit sequence). The result of the shift is permuted using P8 to form the last part of the key. <br />
        For easier understanding of the procedure, key generation is shown in a diagram.
    ',
    'encryptionDecryptionInfoTitle' => 'Encryption/decryption',
    'encryptionDecryptionInfo' => '
        The sequence of 10 bits is permuted in the first stage using an initialization permutation (IP). In the next phase, the data is divided into two halves and the generated part of the key enters the so-called Round function (Round function). This consists of extended permutation (EP), XOR operations, P4 permutation and permutations on two S-boxes. The result of these functions is two blocks of data - at the end of the round, these blocks of data are swapped. After passing through all the rounds, the data blocks are combined and the inversion of the initialization permutation (IP⁻¹) is performed, resulting in the ciphertext. Decryption takes place practically in the same spirit - but the order of partial keys is reversed. That is the last part of the encryption key that enters the first round. <br /><br />
        For better clarity, the diagram is divided into several additional diagrams listed below.
    ',
    'differencesToDESTitle' => 'Implementation differences between S-DES and DES',
    'differencesToDES' => 'Compared to DES, S-DES is modified in several aspects. First of all, it is the length of the processed data blocks - DES works with 64-bit blocks and a 56-bit key. Another major difference is in the number of rounds. In this implementation, S-DES uses only 2 rounds compared to the original 16 rounds. There is also a difference in the round function - in this implementation the operations are simplified. Specifically, P-permutation is reduced, and the permutation by S-box is performed with a reduced S-box.',
    'blockSchema' => 'Simple DES Block Diagram',

    'keyGeneration' => 'Key generation',
    'P10' => 'Permutation P10',
    'split' => 'Split into two blocks',
    'leftShiftLeftKey' => 'Left shift left block',
    'leftShiftRightKey' => 'Left shift right block',
    'shift' => 'Shift',
    'P8KeyOutput' => 'Permutation P8 - creation of block K:keyNumber',
    'IP' => 'IP',
    'EP' => 'EP',
    'xor' => 'XOR operation',
    'SBoxPermutation' => 'Permutation by S-box S:boxNumber',
    'P4' => 'Permutation P4',
    'P8' => 'Permutation P8',
    'swap' => 'Block swap',
    'IIP' => 'IP⁻¹',
    'sBoxes' => 'Predefined S-boxes',
    'roundFunction' => 'Round function',
    'additionalSchemas' => 'Additional diagrams',
    'binaryInput' => 'Binary input of length 8 bits',
    'binaryKey' => 'Binary key of length 10 bits'
];
