<?php

return [
    'title' => 'EduCrypter - A51',
    'annotation' => '
        A5/1 is a stream encryption algorithm that is used in GSM mobile networks to secure communication between mobile phones and mobile stations. The algorithm uses three shift registers (A, B, C) of different lengths (19, 22, 23). During initialization, the key is split into three parts, each initializing one of the three registers. A keystream is generated in each cycle of the algorithm when the registers are shifted and the bits of the keystream are derived from their contents.
        <br /> <br />
        The Majority Function is used to generate the key stream, which operates on three bits from each register A, B, C and returns the value that the majority of these bits hold. This value is then combined into one key stream. The encryption or decryption itself takes place by combining the key stream with plain text or ciphertext using the XOR operation.
        <br /> <br />
        Although the A5/1 was originally designed for security in GSM networks, it was criticized for its lack of security, particularly due to the use of short keys and other weaknesses. For educational purposes, this algorithm is ideal, as it is easy to demonstrate the basics of stream ciphers.
        <br /> <br />
        This A5/1 implementation takes several actions during its initialization. The first part deals with the initialization of the registers with the key (it takes place for 64 bits) - shift of all registers (without majority discrimination) and XOR (⊕) of the first element (for all registers) with the bit from the key. In the next step, the previous action takes place for the 22 bits of the initialization vector (frame number). The last part of the initialization is 100 shifts according to the majority bits. During the encryption/decryption action, a keystream is generated from these registers, which is then XORed (⊕) with the input text.
    ',

    'imageDescription' => 'Scheme of keystream generation and register shift',
    'dataFrame' => 'Number of data frame (init vector)',
    'inputDataFrame' => 'Please insert data frame number',
    'keyStream' => 'Keystream',
    'majorityBit' => 'Majority bit',
    'toBeClocked' => 'Registers to be shifted',
    'registersBeforeClock' => 'Registers before shift',
    'registersAfterClock' => 'Registers after shift',
    'keystreamBit' => 'Keystream bit',
    'inputBit' => 'Input bit',
    'outputBit' => 'Output bit',
];
