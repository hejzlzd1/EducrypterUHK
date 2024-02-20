<?php

return [
    'annotation' => '
        RSA (Rivest-Shamir-Adleman) is an asymmetric encryption and digital signature algorithm first introduced in 1977. Its basic idea is to base encryption on the computational complexity of selected mathematical problems, especially the difficulty of factoring large numbers.
        <br /> <br />
        Key generation begins by choosing two different large prime numbers, p and q, which are multiplied to produce n = pq. The following is the calculation of the Euler function φ(n) = (p-1)(q-1), where φ(n) is the number of numbers less than n that are not commensurate with n. Then the public exponent e is chosen, which is relatively prime to φ(n), and the private exponent d is obtained such that e * d ≡ 1 (mod φ(n)). The private exponent d can be found using the extended Euclidean algorithm.
        <br /> <br />
        The public key is then formed by the pair (n, e), and the private key is formed by the pair (n, d). Encryption is done using the public key (n, e) according to the formula C ≡ M^e (mod n), where C denotes ciphertext and M denotes plain text. Decryption is performed using the private key (n, d) according to the formula M ≡ C^d (mod n).
        <br /> <br />
        RSA provides a secure mechanism for encryption and digital signing, the security of which lies in the complexity of factoring large numbers, a computationally difficult mathematical problem. The computationally demanding nature of the algorithm and the use of asymmetric keys enable the effective provision of secure communication and digital signatures in the cyber environment. RSA is often used for key encryption, digital signatures, and secure key transfers.
        <br /> <br />
        The RSA algorithm is also used to verify the authenticity and integrity of data using a digital signature. The digital signing process is based on the creation of a public and private key. In the first step, the message is hashed using a hash function. This hash is then encrypted with a private key, creating a digital signature. The hash created in this way is sent to the recipient along with the name of the hash function. Signature verification takes place by applying a hash function to the received data and decrypting the obtained hash using a public key. If the hash matches the hash of the message, then the signature is considered valid.
    ',
    'title' => 'Crypto application - RSA',
    'metaComment' => 'This page contains a description and test form of RSA cipher',
    'schema' => 'Diagram of RSA',

    'primeNumber' => 'Prime number',
    'inputTextTooltip' => 'For encryption, enter plain text. For decryption, enter text in ASCII numeric values, each letter separated by a space',
    'asciiText' => 'ASCII value of the text',
    'calculatedVariables' => 'Calculated values',
    'inputChar' => 'Input character in ASCII',
    'outputChar' => 'Output',
    'beforeModulo' => 'Numeric value before the modulus',
    'insertPrimeNumber' => 'Enter a prime number p >= 13, q >= 23',
    'insertPrimeNumberTooltip' => 'The product of prime numbers must be higher than 255 - for the possibility of encrypting all ASCII characters',
    'firstNumberNotPrime' => 'The first number entered is not a prime number',
    'secondNumberNotPrime' => 'The second number entered is not a prime number',
    'primeNumbersAreLow' => 'The product of prime numbers must be higher than 255 - for the possibility of encrypting all ASCII characters',
    'noPrimeNumbers' => 'One of the marked values is not a prime number.',
    'inputPrivateKey' => 'Enter the private key',
    'inputPublicKey' => 'Enter the public key',
];
