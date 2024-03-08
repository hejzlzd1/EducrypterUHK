<?php

return [
    'annotation' => '
        Diffie-Hellmanova výměna klíčů je postup, který se podílí na zajištění zabezpečenou komunikaci mezi dvěma stranami v prostředí, kde není zajištěno bezpečné spojení. Takovým prostředím může být například internet. Tento matematický protokol využívá principů modulární aritmetiky a obtížnosti diskrétního logaritmu k vytvoření společného tajného klíče mezi účastníky. Ustanovaný společný tajný klíč se poté využívá jako klíč pro symetrickou šifru, která je použita k zašifrování komunikace.
        <br /><br />
        TODO: popis fungování algoritmu a popsání root primitive
        <br /><br />
        Po výměně veřejných klíčů každá strana použije svůj soukromý klíč a veřejný klíč protistrany k výpočtu společného tajného klíče. Tímto způsobem se vytvoří společný tajný klíč, který může být použit pro šifrování komunikace symetrickou šifrou.
        <br /><br />
        Důležitou vlastností tohoto protokolu je, že i když veřejné klíče jsou odesílány po veřejných kanálech, není možné získat společný tajný klíč bez znalosti soukromých klíčů. 
    ',
    'title' => 'Krypto aplikace - Diffie-Hellman',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář Diffie-Hellman algoritmu pro výměnu klíčů',
    'schema' => 'Diffie-Hellman ilustrace',
    'keyExchange' => 'Výměna klíčů',
    'keyA' => 'Soukromý klíč Alice (a)',
    'keyB' => 'Soukromý klíč Boba (b)',
    'sharedKey' => 'Společný tajný klíč (S)',
    'inputKey' => 'Vlož celočíselný klíč',
    'publicA' => 'Veřejný klíč Alice (A)',
    'publicB' => 'Veřejný klíč Boba (B)',
    'transferPublicKeys' => 'Výměna veřejných klíčů',
    'function' => 'Funkce pro výpočet',
    'functionOutput' => 'Výstup funkce',
    'calculatePublicA' => 'Výpočet veřejného klíče A',
    'calculatePublicB' => 'Výpočet veřejného klíče B',
    'calculateSecret' => 'Výpočet společného tajného klíče',
    'base' => 'Domluvená grupa (g)',
    'inputBase' => 'Vlož základ, který je primitivním kořenem pro modulus (p)',
    'modulus' => 'Domluvený modulus (p)',
    'inputModulus' => 'Vlož modulus - prvočíslo',
    'userA' => 'Alice',
    'userB' => 'Bob',
];
