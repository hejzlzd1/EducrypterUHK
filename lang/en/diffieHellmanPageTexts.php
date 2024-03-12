<?php
return [
    'annotation' => '
        Diffie-Hellman key exchange is a procedure designed for secure communication between two parties in an environment where a secure connection is not provided. Such an environment can be, for example, the Internet. This mathematical protocol uses the principles of modular arithmetic and discrete logarithm difficulty to create a shared secret key between participants. The established shared secret key is then used as the key for the symmetric cipher that is used to encrypt the communication.
        <br /><br />
        The first step in Diffie-Hellman key exchange is to initialize the public input parameters. These parameters include a random prime (p) and a primitive root modulo p (g). A primitive root modulo n is a number <i>g</i> that for every integer <i>a</i> coprime to <i>p</i> there is some number <i>k</i> for which gᵏ ≡ a (mod p).
        <br /><br />
        In the second step, users generate their own private key, with which they calculate the public key according to the formula <i>A = gᵃ mod p</i>, where <i>a</i> is the user\'s private key. Users then exchange these public keys over an unsecured public channel. Thanks to public keys, it is possible to calculate the shared secret key with the formula <i>S = Bᵃ mod p</i>, where <i>B</i> represents the foreign public key, <i>a</i> is the private key. This shared secret key can be used for communication between the parties.
        <br /><br />
        An important feature of this protocol is that even though public keys are sent over public channels, it is not possible to obtain the shared secret key without knowing the private keys.
    ',
    'title' => 'Educrypter - Diffie-Hellman',
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
    'base' => 'User agreed primitive root modulo p (g)',
    'inputBase' => 'Insert a primitive root for modulus p',
    'modulus' => 'User agreed prime number (p)',
    'inputModulus' => 'Insert prime number',
    'userA' => 'Alice',
    'userB' => 'Bob',
];