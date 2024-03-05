<?php
return [
    'annotation' => '
        Diffie-Hellman key exchange is a procedure designed for secure communication between two parties in an environment where a secure connection is not provided. Such an environment can be, for example, the Internet. This mathematical protocol uses the principles of modular arithmetic and discrete logarithm difficulty to create a shared secret key between participants.
        <br /><br />
        The principle of this protocol consists of several steps. First, both parties agree on common parameters, including the size of the prime modulus and its basis. Then each party generates its private key, which is randomly generated from the given modulus range, and calculates its public key using the formula A = gᵃ mod p - where A is the public key, g the power base, a - the private key, and p - the modulus.
        <br /><br />
        After the exchange of public keys, each party uses its private key and the counterparty\'s public key to calculate a shared secret key. This creates a shared secret key that can be used to encrypt communications between the parties.
        <br /><br />
        An important feature of this protocol is that even though public keys are sent over public channels, it is not possible to obtain the shared secret key without knowing the private keys.
    ',
    'title' => 'Crypto Application - Diffie-Hellman',
    'metaComment' => 'This page contains a description and test form of the Diffie-Hellman key exchange algorithm',
    'schema' => 'Diffie-Hellman illustration',
    'keyExchange' => 'Key Exchange',
    'keyA' => 'Private key of user A (a)',
    'keyB' => 'Private key of user B (b)',
    'sharedKey' => 'Shared Secret Key (S)',
    'inputKey' => 'Insert integer key',
    'publicA' => 'Public key of user A',
    'publicB' => 'Public key of user B',
    'secretA' => 'Shared secret key of user A',
    'secretB' => 'Shared secret key of user B',
    'transferPublicKeys' => 'Exchange public keys',
    'function' => 'Calculation function',
    'functionOutput' => 'Function Output',
    'calculatePublicA' => 'Calculating public key A',
    'calculatePublicB' => 'Calculate public key B',
    'calculateSecret' => 'Calculate Shared Secret',
    'base' => 'User agreed base (g)',
    'inputBase' => 'Insert Base',
    'modulus' => 'User agreed modulus (p)',
    'inputModulus' => 'Insert modulus - prime number',
    'userA' => 'User A',
    'userB' => 'User B',
];