<?php
return [
    'annotation' => '
        Diffie-Hellman key exchange is a procedure designed for secure communication between two parties in an environment where a secure connection is not provided. Such an environment can be, for example, the Internet. This mathematical protocol uses the principles of modular arithmetic and discrete logarithm difficulty to create a shared secret key between participants. The established shared secret key is then used as the key for the symmetric cipher that is used to encrypt the communication.
        <br /><br />
        TODO algorithm description
        <br /><br />
        After the exchange of public keys, each party uses its private key and the counterparty\'s public key to calculate a shared secret key. This creates a shared secret key that can be used to encrypt communications between the parties.
        <br /><br />
        An important feature of this protocol is that even though public keys are sent over public channels, it is not possible to obtain the shared secret key without knowing the private keys.
    ',
    'title' => 'Crypto Application - Diffie-Hellman',
    'metaComment' => 'This page contains a description and test form of the Diffie-Hellman key exchange algorithm',
    'schema' => 'Diffie-Hellman illustration',
    'keyExchange' => 'Key Exchange',
    'keyA' => 'Private key of Alice (a)',
    'keyB' => 'Private key of Bob (b)',
    'sharedKey' => 'Shared Secret Key (S)',
    'inputKey' => 'Insert integer key',
    'publicA' => 'Public key of Alice (A)',
    'publicB' => 'Public key of Bob (B)',
    'transferPublicKeys' => 'Exchange public keys',
    'function' => 'Calculation function',
    'functionOutput' => 'Function Output',
    'calculatePublicA' => 'Calculating public key A',
    'calculatePublicB' => 'Calculate public key B',
    'calculateSecret' => 'Calculate Shared Secret',
    'base' => 'User agreed base (g)',
    'inputBase' => 'Insert a base that is a primitive root for modulus (p)',
    'modulus' => 'User agreed modulus (p)',
    'inputModulus' => 'Insert modulus - prime number',
    'userA' => 'Alice',
    'userB' => 'Bob',
];