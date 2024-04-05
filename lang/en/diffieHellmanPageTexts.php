<?php
return [
    'annotation' => '
        Diffie-Hellman key exchange is a procedure involved in ensuring secure communication between two parties in an environment where a secure connection is not provided. Such an environment can be, for example, the Internet. This mathematical protocol uses the principles of modular arithmetic and discrete logarithm difficulty to create a shared secret key between participants. The established shared secret key is then used as the key for the symmetric cipher that is used to encrypt the communication.
        <br /><br />
        The first step in Diffie-Hellman key exchange is to initialize the public input parameters. These parameters include a random prime (p) and a primitive root modulo p (g). A primitive root modulo p is a number g such that for every integer <i>a</i> not commensurate with <i>p</i> there exists an integer <i>k</i> such that <i>gᵏ ≡ a (mod p)</i>.
        <br /><br />
        In the second step, Alice and Bob generate their own private key, Alice key a, Bob key b, with which they calculate the public key according to the formula <i>A = gᵃ mod p</i>, or <i>B = gᵇ mod p</i> where <i>a,b</i> are user\'s private keys. Users then exchange these public keys over an unsecured public channel. Thanks to public keys, it is possible to calculate a common secret key using the formula <i>S = Bᵃ mod p</i>, or S = Aᵇ mod p, where <i>A,B</i> represent foreign public keys, <i>a ,b</i> are private keys. In this way, a common secret key is created that is known to both communicating parties and can be used to encrypt communication with a symmetric cipher.
        <br /><br />
        An important feature of this protocol is that even though public keys are sent over public channels, it is not possible to obtain the shared secret key without knowing the private keys.
    ',
    'title' => 'EduCrypter - Diffie-Hellman',
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
