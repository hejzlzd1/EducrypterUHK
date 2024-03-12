<?php

return [
    'title' => 'Educrypter - Blowfish cipher',
    'metaComment' => 'This page contains theory and test form of blowfish cipher',
    'annotation' => 'Blowfish is a symmetric key block cipher designed in 1993 by Bruce Schneier. It is a fast, relatively secure encryption algorithm that has been used for use in a variety of applications, including e-commerce, virtual private networks (VPNs), and password storage.
                       <br/><br/>
Blowfish uses a variable-length key, from 32 to 448 bits, and works with 64-bit plain text blocks. The key is used to initialize a set of subkeys that are used in a series of 16 rounds of encryption and decryption.
<br/><br/>
Subkeys are derived from the master key using a key planning algorithm, which consists of a series of operations that shuffle key bits to create subkeys. The key planning algorithm uses a series of S-boxes, which are precomputed tables of substitution values, to shuffle key bits and create subkeys.
<br/><br/>
Each round of the encryption and decryption process consists of three operations: an XOR operation with a partial key, performing a round function on the result of the previous step, XORing the right part of the block with the result of the round function, and swapping the left and right halves of the block (left XOR, right round function + XOR ).
<br/><br/>
One of the key features of the Blowfish cipher is its scalability. A variable length key allows for different levels of security depending on the length of the key used. The Blowfish cipher is also designed to be fast and efficient, making it suitable for use in applications that require high encryption and decryption speeds.
<br/><br/>
Despite its age, Blowfish remains a popular encryption algorithm. It has been thoroughly studied and analyzed by cryptographers, and no serious flaws have been found in its design. However, it is not recommended for use in new applications as it has been largely replaced by newer algorithms such as Twofish.
                    ',
    'blockSchema' => 'Block schema of blowfish',
    'leftInput' => 'Left block',
    'rightInput' => 'Right block',
    'leftBlockXorOutput' => 'Left block XOR subkey',
    'rightBlockFeistelOutput' => 'Round function output',
    'rightBlockXorOutput' => 'F function output XOR right block',
    'rightBlockXorKeyOutput' => 'Right block XOR subkey',
];
