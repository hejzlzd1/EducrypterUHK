<?php

return [
    'annotation' => '
        RSA (Rivest-Shamir-Adleman) je asymetrický šifrovací a digitální podpisový algoritmus, který byl poprvé představen v roce 1977. Jeho základní myšlenkou je založení šifrování na matematických vlastnostech obtížných problémů, zejména na obtížnosti faktorizace velkých prvočísel.
        <br /> <br />
        Generování klíčů začíná výběrem dvou různých velkých prvočísel, p a q, která jsou násobena, vytvářejíc n = pq. Následuje výpočet Eulerovy funkce φ(n) = (p-1)(q-1), což je počet čísel menších než n, která jsou nesoudělná s n. Poté se volí veřejný exponent e, který je relativně prvočíslo k φ(n), a privátní exponent d je získán tak, aby platilo e * d ≡ 1 (mod φ(n)) pomocí rozšířeného Eukleidova algoritmu.
        <br /> <br />
        Veřejný klíč je pak tvořen dvojicí (n, e), a soukromý klíč je tvořen dvojicí (n, d). Šifrování se provádí pomocí veřejného klíče (n, e) podle vzorce C ≡ M^e (mod n), a dešifrování se provádí pomocí privátního klíče (n, d) podle vzorce M ≡ C^d (mod n).
        <br /> <br />
        RSA poskytuje bezpečný mechanismus pro šifrování a digitální podepisování, přičemž jeho bezpečnost spočívá ve složitosti faktorizace velkých čísel, což je obtížný matematický problém. Výpočetně náročný charakter algoritmu a jeho využívání asymetrických klíčů umožňují efektivní zajištění bezpečné komunikace a digitálních podpisů v kybernetickém prostředí. RSA se často využívá pro šifrování klíčů, digitální podpisy a bezpečné přenosy klíčů.
    ',
    'title' => 'Krypto aplikace - RSA',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář RSA šifry',
    'schema' => 'Blokové schéma RSA',

    'primeNumber' => 'Prvočíslo',
    'inputTextTooltip' => 'V případě šifrování vlož běžný text, pro dešifrování vlož text v ASCII číselných hodnotách každé písmeno odděleno mezerou',
    'asciiText' => 'ASCII hodnota textu',
    'calculatedVariables' => 'Vypočítané hodnoty',
    'inputChar' => 'Vstupní znak v ASCII',
    'outputChar' => 'Výstup',
    'beforeModulo' => 'Číselná hodnota před modulem',
    'insertPrimeNumber' => 'Zadej prvočíslo p >= 13, q >= 23',
    'insertPrimeNumberTooltip' => 'Součin prvočísel musí být vyšší jak 255 - pro možnost zašifrování všech znaků z ASCII',
    'firstNumberNotPrime' => 'První zadané číslo není prvočíslo',
    'secondNumberNotPrime' => 'Druhé zadané číslo není prvočíslo',
    'primeNumbersAreLow' => 'Součin prvočísel musí být vyšší jak 255 - pro možnost zašifrování všech znaků z ASCII',
    'noPrimeNumbers' => 'Jedna z označených hodnot není prvočíslem.',
    'inputPrivateKey' => 'Vlož soukromý klíč',
    'inputPublicKey' => 'Vlož veřejný klíč',
];
