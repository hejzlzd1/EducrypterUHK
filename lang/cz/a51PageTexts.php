<?php

return [
    'title' => 'Krypto aplikace - A5/1',
    'annotation' => '
        A5/1 je proudový šifrovací algoritmus, který se využívá v mobilních sítích GSM pro zabezpečení komunikace mezi mobilními telefony a mobilními stanicemi. Algoritmus používá tři posuvné registry (A, B, C) o různých délkách (19, 22, 23). Při inicializaci se klíč rozdělí na tři části, každá inicializuje jeden ze tří registrů. Klíčový proud (key stream) je generován v každém taktu algoritmu, kdy registry jsou posunuty a bity klíčového proudu jsou odvozeny z jejich obsahu.
        <br /> <br />
        Pro generování klíčového proudu se využívá funkce většiny (Majority Function), která operuje na třech bitech z každého registru A, B, C a vrací hodnotu, kterou většina těchto bitů zastává. Tato hodnota je poté kombinována do jednoho klíčového proudu. Samotné šifrování nebo dešifrování probíhá kombinací klíčového proudu s otevřeným textem nebo zašifrovaným textem pomocí operace XOR.
        <br /> <br />
        Ačkoliv byl A5/1 původně navržen pro bezpečnost v GSM sítích, byl kritizován kvůli nedostatečné bezpečnosti, zejména vzhledem k použití krátkých klíčů a dalším slabostem. Pro vzdělávací účely je tento algoritmus naprosto ideální jelikož na něm lze snadno demonstrovat základy proudových šifer.
        <br /> <br />
        Tato implementace A5/1 provádí při své inicializaci několik akcí. V první části se jedná o inicializaci registrů klíčem (ta probíhá pro 64 bitů) - posun všech registrů (bez majoritního rozlišování) a XOR (⊕) prvního prvku (u všech registrů) s bitem z klíče. V dalším kroku probíhá předchozí akce pro 22 bitů inicializačního vektoru (číslo rámce). Poslední částí inicializace je 100 posunů dle majoritních bitů. Při akci šifrování/dešifrování se z těchto registrů vygeneruje key stream (klíč), ten je následně XORován (⊕) se vstupním textem.
    ',

    'imageDescription' => 'Schéma tvorby šifrovacího klíče a posunu registrů',
    'dataFrame' => 'Číslo rámce (init vector)',
    'dataFrameNumberExplanation' => 'Číslo rámce (IV - Init vector) je náhodně či předem určená číslice, které při prvotní inicializaci algoritmu ovlivní hodnoty v registrech.',
    'inputDataFrame' => 'Vložte číslo rámce',
    'keyStream' => 'Šifrovací klíč',
    'majorityBit' => 'Majoritní bit',
    'toBeClocked' => 'Registry k posunu',
    'registersBeforeClock' => 'Registry před posunem',
    'registersAfterClock' => 'Registry po posunu',
    'keystreamBit' => 'Bit šifrovacího klíče',
    'inputBit' => 'Vstupní bit',
    'outputBit' => 'Výstupní bit',
];
