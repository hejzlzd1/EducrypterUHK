<?php
return [
    'title' => 'Crypto application - Triple DES',
    'metaComment' => 'This page contains a description and trial form of the Triple DES cipher',
    'annotation' => '
        Triple DES (3DES) is an encryption algorithm that uses <a href="/simpleDesCipher">Data Encryption Standard (DES)</a>. DES itself was built on a Feistel network that uses 56-bit keys, which may be considered insufficient for modern security standards. Triple DES comes as an improved version of DES to increase security through the use of multiple layers of DES.
        <br /> <br />
        In Triple DES, the pass through the DES algorithm is used three times, either in EDE (Encrypt, Decrypt, Encrypt) or EEE (Encrypt, Encrypt, Encrypt) mode. In the first mode (EDE), the three keys are referred to as K1, K2, and K3, with the first encryption done with K1, decryption with K2, and finally encryption again with K3. In EEE mode, all three encryption operations are performed (keys are used in the order K1, K2, K3). In the case of decryption, the encryption/decryption operations and keys are used in the reverse order, i.e. DED (Decrypt, Encrypt, Decrypt).
        <br /> <br />
        Triple DES provides a higher level of security than the original DES while maintaining compatibility with existing systems that still use DES. It is used where a greater level of security is required than DES can provide. With three layers of encryption, Triple DES is better able to withstand cryptanalytic attacks that could compromise the use of single DES. It is suitable for secure encryption while retaining some of the benefits of the original DES.
        <br /> <br/>
        This 3-DES implementation is built on top of <a href="/simpleDesCipher">S-DES</a> for educational reasons, as using this implementation allows you to better understand the structure and operation of 3DES. Three keys K1, K2 and K3 are accepted as input, which leads to a sufficient level of security in the case of the full algorithm.
    ',
    'blockSchema' => 'Triple DES block diagram',

];
