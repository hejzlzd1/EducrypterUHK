<?php

return [
    'annotation' => '
        RSA (Rivest-Shamir-Adleman) is an asymmetric encryption and digital signature algorithm that was first introduced in 1977. Its basic idea is to base encryption on the mathematical properties of difficult problems, especially the difficulty of factoring large prime numbers.
        <br /> <br />
        Key generation begins by choosing two different large prime numbers, p and q, which are multiplied to produce n = pq. This is followed by the calculation of the Euler function φ(n) = (p-1)(q-1), which is the number of numbers less than n that are incommensurate with n. Then the public exponent e is chosen, which is relatively prime to φ(n) , and the private exponent d is obtained such that e * d ≡ 1 (mod φ(n)) using the extended Euclidean algorithm.
        <br /> <br />
        The public key is then formed by the pair (n, e), and the private key is formed by the pair (n, d). Encryption is performed using the public key (n, e) according to the formula C ≡ M^e (mod n), and decryption is performed using the private key (n, d) according to the formula M ≡ C^d (mod n).
        <br /> <br />
        RSA provides a secure mechanism for encryption and digital signing, the security of which lies in the complexity of factoring large numbers, a difficult mathematical problem. The computationally demanding nature of the algorithm and its use of asymmetric keys enable effective provision of secure communication and digital signatures in the cyber environment. RSA is often used for key encryption, digital signatures, and secure key transfers.
    ',
    'title' => 'Crypto application - RSA',
    'metaComment' => 'This page contains a description and test form of RSA cipher',
    'schema' => 'Block diagram of RSA',

    'primeNumber' => 'Prime number',
    'asciiText' => 'ASCII value of the text',
    'calculatedVariables' => 'Calculated values',
    'inputChar' => 'Input character in ASCII',
    'outputChar' => 'Output',
    'beforeModulo' => 'Numeric value before the modulus',
    'insertPrimeNumber' => 'Enter a prime number',
    'insertPrimeNumberTooltip' => 'The product of prime numbers must be higher than 255 - for the possibility of encrypting all ASCII characters',
    'firstNumberNotPrime' => 'The first number entered is not a prime number',
    'secondNumberNotPrime' => 'The second number entered is not a prime number',
    'primeNumbersAreLow' => 'The product of prime numbers must be higher than 255 - for the possibility of encrypting all ASCII characters',
    'noPrimeNumbers' => 'One of the marked values is not a prime number.',
    'inputPrivateKey' => 'Enter the private key',
    'inputPublicKey' => 'Enter the public key',
];
