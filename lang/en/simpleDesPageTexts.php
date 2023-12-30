<?php

return [
    'title' => 'Crypto application - Simple DES',
    'metaComment' => 'This page contains a description and test form of the Simple DES cipher',
    'annotation' => '
       Simple DES (S-DES) is a simplified version of the classic Data Encryption Standard (DES) encryption algorithm. It was designed for educational purposes and provides a clear and easy to understand view of the basics of block cipher and a simplified view of the original DES. This algorithm is not intended for real application security as it can be easily broken due to the short key length.<br /> <br />
       The work of S-DES is divided into several parts, which are described below.           
    ',
    'keyGenerationInfoTitle' => 'Key generation',
    'keyGenerationInfo' => '
        The input key (10-bit sequence) is length-verified in the first phase. If the key is too long then it is truncated, otherwise it is padded with zeros from the left. <br />
        This verified key then goes through permutations and register shifts. In the first part the key goes through permutation P10 - its output is divided into two parts (5-bits) over which the left register shift (1x) is performed. <br />
        The shifted 5-bit sequences are subject to P8 permutation, which results in the first key of 8 bits. The output of the shift registers is subject to two more shifts (4 -> 2x for each half of the 5-bit sequence). The result of the shift is permuted with P8 to produce the last part of the key.<br />
        To make the procedure easier to understand, the key generation is shown in the diagram - it is the middle part of the image.
    ',
    'encryptionDecryptionInfoTitle' => 'Encryption/decryption',
    'encryptionDecryptionInfo' => '
        The 10-bit data is permuted in the first phase using an initialization permutation. In the next phase, the data is split into two halves and enters the so-called complex function (run) with the generated part of the key. This consists of an extended permutation (EP), XOR operations, P4 permutations and permutations on two sboxes. These functions result in two parts of data - at the end of the run, the (sides of the data) are swapped. After going through all the rounds, the data is concatenated and an inversion of the initialization permutation is performed to produce an encrypted output. 
        Decryption proceeds in practically the same way - but the order of the key parts is reversed, i.e. the last part of the encryption key enters the first round.<br /><br />
        The scheme of this algorithm is too complex to fit into a single figure. The structure of all the operations used is therefore shown in the figures below.
    ',
    'differencesToDESTitle' => 'Implementation differences of S-DES versus DES',
    'differencesToDES' => 'Compared to DES, S-DES is modified in several aspects. The first is the length of the data processed - DES works with 64-bit blocks and a 56-bit key. Another major difference is the number of rounds. In this implementation, S-DES uses only 2 rounds compared to the original 16 rounds. There is also a difference in complex functions - in this implementation, operations are simplified (permutations of sboxes for example).',
    'blockSchema' => 'Simple DES Block Diagram',

    'keyGeneration' => 'Key generation',
    'P10' => 'Permutation P10',
    'split' => 'Split to two parts',
    'leftShiftLeftKey' => 'Left key shift register',
    'leftShiftRightKey' => 'Right key shift register',
    'shift' => 'Shift',
    'P8KeyOutput' => 'Permutation P8 - creation of key K:keyNumber',
    'IP' => 'Initial permutation (IP)',
    'EP' => 'Expanded permutation (EP)',
    'xor' => 'XOR operation',
    'SBoxPermutation' => 'Permutation by SBox #:boxNumber',
    'P4' => 'Permutation P4',
    'P8' => 'Permutation P8',
    'swap' => 'Side swap',
    'IIP' => 'Inversion of initial permutation (IIP)',
    'sBoxes' => 'Predefined Sboxes',
    'complexFunction' => 'Complex function (round)',
    'additionalSchemas' => 'Additional diagrams'
];
