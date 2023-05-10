<?php
return [
    "title" => "Crypto application - Blowfish cipher",
    "metaComment" => "This page contains theory and test form of blowfish cipher",
    "annotation" => "Blowfish is a symmetric key block cipher designed by Bruce Schneier in 1993. It is a fast, relatively secure encryption algorithm that has been suitable for use in a variety of applications, including e-commerce, virtual private networks (VPNs), and password storage.
                    <br/><br/>
                    Blowfish uses a variable-length key, from 32 to 448 bits, and works with 64-bit plaintext blocks. The key is used to initialize a set of subkeys that are used in a series of 16 rounds of encryption and decryption.
                    <br/><br/>
The subkeys are derived from the key using a key scheduling algorithm, which consists of a series of operations that shuffle the bits of the key to produce the subkeys. The key scheduling algorithm uses a series of S-boxes, which are precomputed tables of substitution values, to shuffle the key bits and generate the subkeys.
                    <br/><br/>
Each round of the encryption and decryption process consists of three operations: an XOR operation with a subkey, the execution of a feistel function over the result of the previous step, the xor of the right part of the block with the result of the feistel function, and the swapping of the left and right halves of the block (left xor, right feistel + xor).
                    <br/><br/>
One of the key features of the Blowfish cipher is its scalability. The variable-length key allows different levels of security depending on the length of the key used. The Blowfish cipher is also designed to be fast and efficient, making it suitable for use in applications that require high speed encryption and decryption.
                    <br/><br/>
Despite its age, Blowfish remains a popular encryption algorithm. It has been thoroughly studied and analyzed by cryptographers and no serious flaws have been found in its design. However, it is not recommended for use in new applications because it has largely been replaced by newer algorithms such as Twofish.
                    ",
    "blockSchema" => "Block schema of blowfish",
    "leftInput" => "Left block",
    "rightInput" => "Right block",
    "leftBlockXorOutput" => "Left block XOR subkey",
    "rightBlockFeistelOutput" => "Feistel function output",
    "rightBlockXorOutput" => "F function output XOR right block",
    "rightBlockXorKeyOutput" => "Right block XOR subkey",
];
