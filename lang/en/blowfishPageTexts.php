<?php
return [
    "title" => "Crypto application - Blowfish cipher",
    "metaComment" => "This page contains theory and test form of blowfish cipher",
    "annotation" => "Blowfish is a symmetric-key block cipher that was designed by Bruce Schneier in 1993. It is a fast, secure, and widely used encryption algorithm that is suitable for use in a variety of applications, including e-commerce, virtual private networks (VPNs), and password storage.
                    <br/><br/>
                    Blowfish uses a variable-length key, ranging from 32 to 448 bits, and operates on 64-bit blocks of plaintext. The key is used to initialize a set of subkeys that are used in a series of 16 rounds of encryption and decryption.
                    <br/><br/>
The subkeys are derived from the key using a key schedule algorithm, which consists of a series of operations that mix the key bits and produce the subkeys. The key schedule algorithm uses a series of S-boxes, which are precomputed tables of substitution values, to mix the key bits and produce the subkeys.
                    <br/><br/>
Each round of the encryption and decryption process consists of four operations: a substitution operation, a permutation operation, a XOR operation with a subkey, and a swapping of the left and right halves of the block. The substitution operation uses the S-boxes to replace blocks of plaintext with different values, while the permutation operation shuffles the bits of the block.
                    <br/><br/>
The XOR operation with a subkey is used to add confusion to the encryption process and make it more difficult to analyze. The swapping of the left and right halves of the block is used to create a Feistel structure, which is a common design pattern used in block ciphers to create a reversible transformation.
                    <br/><br/>
One of the key features of Blowfish is its scalability. The variable-length key allows for different levels of security depending on the length of the key used. Blowfish is also designed to be fast and efficient, making it suitable for use in applications that require high-speed encryption and decryption.
                    <br/><br/>
Despite its age, Blowfish remains a popular and widely used encryption algorithm. It has been extensively studied and analyzed by cryptographers, and no major weaknesses have been found in its design. However, it is not recommended for use in new applications, as it has been largely replaced by newer algorithms such as AES (Advanced Encryption Standard).
                    ",
    "blockSchema" => "Block schema of blowfish",
];
