<?php

return [
    'title' => 'Crypto application - A51',
    'annotation' => '
        A5/1 is a stream cipher algorithm used in GSM mobile networks to secure communication between mobile phones and mobile stations. The algorithm uses three shift registers (A, B, C) of different lengths (19, 22, 23). During initialization, the key is divided into three parts, each initializing one of the three registers. A keystream is generated at each clock cycle when the registers are shifted and the bits of the keystream are derived from their contents.
        <br /> <br /> 
        To generate the key stream, the Majority Function is used, which operates on three bits from each register A, B, C and returns the value that the vast majority of these bits hold. This value is then combined into a single key stream. The actual encryption or decryption is done by combining the key stream with the plaintext or ciphertext using an XOR operation.
        <br /> <br /> 
        Although the A5/1 was originally designed for security in GSM networks, it has been criticized for its lack of security, especially due to the use of short keys and other weaknesses. For educational purposes, this algorithm is ideal as it can easily be used to demonstrate the basics of stream ciphers.
        <br /> <br />
        The current A5/1 implementation performs several actions during its initialization. The first part is the initialization of the registers with the key (this is done for 64 bits) - shifting all registers (without majority resolution) and XOR (⊕) first element in registers with a bit from the key. In the next part, the same action takes place but for 22 bits of the initialization vector (frame number). The last part of the initialization is 100 shifts according to the majority bits. During the encryption/decryption action, a so-called keystream (key) is generated from these registers, which is then used by XOR (⊕) operations against the input.
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
