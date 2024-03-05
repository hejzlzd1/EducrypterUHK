<?php

return [
    'annotation' => '
        Diffie-Hellmanova výměna klíčů je postup navržený pro zabezpečenou komunikaci mezi dvěma stranami v prostředí, kde není zajištěno bezpečné spojení. Takovým prostředím může být například internet. Tento matematický protokol využívá principů modulární aritmetiky a obtížnosti diskrétního logaritmu k vytvoření společného tajného klíče mezi účastníky.
        <br /><br />
        Princip tohoto protokolu spočívá v několika krocích. Nejprve se obě strany dohodnou na společných parametrech, včetně velikosti prvočíselného modulusu a jeho základu, který je náhodným číslem z rozmezí daného modulusu. Poté každá strana generuje svůj soukromý klíč, který je náhodně vygenerován z rozsahu daného modulusu, a vypočítá svůj veřejný klíč pomocí vzorce A = gᵃ mod p - kde A je veřejný klíč, g mocniný základ, a - soukromý klíč a p - modulus.
        <br /><br />
        Po výměně veřejných klíčů každá strana použije svůj soukromý klíč a veřejný klíč protistrany k výpočtu společného tajného klíče. Tímto způsobem se vytvoří společný tajný klíč, který může být použit pro šifrování komunikace mezi stranami.
        <br /><br />
        Důležitou vlastností tohoto protokolu je, že i když veřejné klíče jsou odesílány po veřejných kanálech, není možné získat společný tajný klíč bez znalosti soukromých klíčů. 
    ',
    'title' => 'Krypto aplikace - Diffie-Hellman',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář Diffie-Hellman algoritmu pro výměnu klíčů',
    'schema' => 'Diffie-Hellman ilustrace',
    'keyExchange' => 'Výměna klíčů',
    'keyA' => 'Soukromý klíč uživatele A (a)',
    'keyB' => 'Soukromý klíč uživatele B (b)',
    'sharedKey' => 'Společný tajný klíč (S)',
    'inputKey' => 'Vlož celočíselný klíč',
    'publicA' => 'Veřejný klíč uživatele A',
    'publicB' => 'Veřejný klíč uživatele B',
    'secretA' => 'Společný tajný klíč uživatele A',
    'secretB' => 'Společný tajný klíč uživatele B',
    'transferPublicKeys' => 'Výměna veřejných klíčů',
    'function' => 'Funkce pro výpočet',
    'functionOutput' => 'Výstup funkce',
    'calculatePublicA' => 'Výpočet veřejného klíče A',
    'calculatePublicB' => 'Výpočet veřejného klíče B',
    'calculateSecret' => 'Výpočet společného tajného klíče',
    'base' => 'Domluvený základ (g)',
    'inputBase' => 'Vlož základ',
    'modulus' => 'Domluvený modulus (p)',
    'inputModulus' => 'Vlož modulus - prvočíslo',
    'userA' => 'Uživatel A',
    'userB' => 'Uživatel B',
];
