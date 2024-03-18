<?php

return [
    'annotation' => '
        Diffie-Hellmanova výměna klíčů je postup, který se podílí na zajištění zabezpečenou komunikaci mezi dvěma stranami v prostředí, kde není zajištěno bezpečné spojení. Takovým prostředím může být například internet. Tento matematický protokol využívá principů modulární aritmetiky a obtížnosti diskrétního logaritmu k vytvoření společného tajného klíče mezi účastníky. Ustanovený společný tajný klíč se poté využívá jako klíč pro symetrickou šifru, která je použita k zašifrování komunikace.
        <br /><br />
        První krok při Diffie-Hellmanově výměně klíčů spočívá v inicializaci veřejných vstupních parametrů. Mezi tyto parametry patří náhodné prvočíslo (p) a primitivní kořen modulo p (g). Primitivní kořen modulo p je takové číslo g, pro které platí, že pro každé celé číslo <i>a</i> nesoudělné s <i>p</i> existuje celé číslo <i>k</i>, takové, že gᵏ ≡ a (mod p). 
        <br /><br />
        V druhém kroku Alice a Bob vygenerují svůj vlastní soukromý klíč, Alice klíč a, Bob klíč b, pomocí kterého vypočítají veřejný klíč dle vzorce <i>A = gᵃ mod p</i>, případně B = gᵇ mod p<i></i> kde <i>a,b</i> jsou soukromé klíče uživatelů. Tyto veřejné klíče si následně uživatelé vymění po nezabezpečeném veřejném kanálu. Díky veřejným klíčům je možné vypočítat společný tajný klíč vzorcem <i>S = Bᵃ mod p</i>, případně S = Aᵇ mod p, kde <i>A,B</i> představují cizí veřejné klíče, <i>a,b</i> jsou vlastní soukromé klíče. Tímto způsobem se vytvoří společný tajný klíč, který znají obě komunikující strany a může být použit pro šifrování komunikace symetrickou šifrou.
        <br /><br />
        Důležitou vlastností tohoto protokolu je, že i když veřejné klíče jsou odesílány po veřejných kanálech, není možné získat společný tajný klíč bez znalosti soukromých klíčů. 
    ',
    'title' => 'EduCrypter - Diffie-Hellman',
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
    'base' => 'Domluvený primitivní kořen modulo p (g)',
    'inputBase' => 'Vlož primitivní kořen pro modulus p',
    'modulus' => 'Prvočíslo (p)',
    'inputModulus' => 'Vlož prvočíslo',
    'userA' => 'Alice',
    'userB' => 'Bob',
];
