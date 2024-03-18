<?php

return [
    'title' => 'EduCrypter - S-DES',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář S-DES šifry',
    'annotation' => '
       Simple DES (S-DES) je zjednodušená verze klasického šifrovacího algoritmu Data Encryption Standard (DES). Byl navržen pro výukové účely a poskytuje přehledný a snadno pochopitelný náhled na základy blokového šifrování a zjednodušený pohled na původní DES. Tento algoritmus není určen pro reálné zabezpečení aplikace, jelikož lze snadno prolomit kvůli krátké délce klíče. <br /> <br />
       Práce S-DES je rozdělena do několika částí, které jsou popsány níže.
    ',
    'keyGenerationInfoTitle' => 'Generování klíčů',
    'keyGenerationInfo' => '
        U vstupního klíče (10-bitová sekvence) se v první fázi validuje počet znaků. Pokud je klíč příliš dlouhý pak je zkrácen, v opačném případě je zleva doplněn o nuly. <br />
        Takto ověřený klíč následně prochází permutacemi a posuny registru. V první části prochází klíč permutací P10 - její výstup je rozdělen na dvě části (5-bitů) nad kterými je proveden levý posun registru (1x). <br />
        Posunuté 5-bitové sekvence vstupují do permutace P8. Výstupem permutace P8 je první klíč o 8 bitech. Výstup z posunu registrů podléhá dalším dvěma posunům. Celkem se posun provede 4x (2x pro každou půlku 5-bitové sekvence). Výsledek posunu je permutován pomocí P8 a vzniká poslední část klíče. <br />
        Pro jednodušší pochopení postupu je generování klíčů vyobrazeno ve schématu.
    ',
    'encryptionDecryptionInfoTitle' => 'Šifrování/dešifrování',
    'encryptionDecryptionInfo' => '
        Sekvence 10-bitů je v první fázi permutována pomocí inicializační permutace (IP). V další fázi se data rozdělí na dvě poloviny a s vygenerovanou částí klíče vchází do tzv. rundovní funkce (Round function). Ta se skládá z rozšířené permutace (EP), XOR operací, permutace P4 a permutací na dvou S-boxech. Výsledkem těchto funkcí jsou dva bloky dat - na konci rundy se tyto bloky dat prohodí. Po průchodu všemi rundami jsou bloky dat spojeny a provede se inverze inicializační permutace (IP⁻¹) čímž vznikne šifrový text. Dešifrování probíhá prakticky ve stejném duchu - avšak je otočeno pořadí dílčích klíčů. Tzn. do první rundy vstupuje poslední část šifrovacího klíče. <br /><br />
        Pro lepší přehlednost je schéma rozdělené do několika doplňujících diagramů uvedených níže.
    ',
    'differencesToDESTitle' => 'Implementační rozdíly S-DES proti DES',
    'differencesToDES' => 'Oproti DES je S-DES upraven v několika aspektech. V první řadě se jedná o délku zpracovávaných bloků dat - DES pracuje s 64-bitovými bloky a 56-bitovým klíčem. Další zásadní rozdíl je v počtu rund. V této implementaci využívá S-DES pouze 2 rundy oproti původním 16 rundám. Taktéž je zde odlišnost v rundovní funkci - v této implementaci jsou operace zjednodušeny. Konkrétně se jedná o zmenšené P-permutace a permutace se zmenšeným S-boxem.',
    'blockSchema' => 'Blokové schéma Simple DES',
    'keyGeneration' => 'Generování klíčů',
    'P10' => 'Permutace P10',
    'split' => 'Rozdělení na dva bloky',
    'leftShiftLeftKey' => 'Posunutí registru levého bloku',
    'leftShiftRightKey' => 'Posunutí registru pravého bloku',
    'shift' => 'Posun',
    'P8KeyOutput' => 'P8 - vytvoření bloku K:keyNumber',
    'IP' => 'IP',
    'EP' => 'EP',
    'xor' => 'Operace XOR',
    'SBoxPermutation' => 'Permutace S-boxem S:boxNumber',
    'P4' => 'Permutace P4',
    'P8' => 'Permutace P8',
    'swap' => 'Prohození bloků',
    'IIP' => 'IP⁻¹',
    'sBoxes' => 'Předdefinované S-boxy',
    'roundFunction' => 'Rundovní funkce',
    'additionalSchemas' => 'Doplňující schémata',
    'binaryInput' => 'Binární vstup o délce 8 bitů',
    'binaryKey' => 'Binární klíč o délce 10 bitů'
];
