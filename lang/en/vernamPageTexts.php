<?php

return [
    'title' => 'Crypto application - Vernam Cipher',
    'metaComment' => 'This page contains a description and trial form of the Vernam cipher',
    'annotation' => '
        The Vernam cipher, also known as the one-time table cipher or one-time pad, is a symmetric cryptographic method that uses the exclusive logical operation XOR (exclusive OR). The basic principle is that each character in the plain text is combined with the corresponding character in the secret key.
        To use the Vernam cipher properly, the key is generated randomly and is used only once. It is important that the key has the same length as the message we are encrypting. The key can contain any characters, but binary format is often used.
        <br /> <br />
        Encryption is done by combining each plain text character with the corresponding key character using an XOR operation. This means that if both bits are the same, the result is zero, otherwise the result is one.
        Decryption is done in the same way. Each character of the ciphertext is combined with the corresponding character of the key using an XOR operation, resulting in the recovery of the original plain text.
        <br /> <br />
        It is important that the key is used only once and then destroyed. This procedure ensures a higher level of security for this encryption procedure. The Vernam cipher provides a high degree of secrecy, but practical challenges such as secure key distribution may limit its practical use in real-world applications.
        <br />
        This implementation of Vernam cipher takes binary inputs and provides binary output. If the binary key is too short, it is padded with 0 from the left side. In the case when input text is longer than key, then the key is cut from the left side. The steps of the algorithm show the individual XOR operations performed on input text.
    ',
    'schema' => 'Vernam cipher binary encryption scheme',
];
