<?php

return [
    'title' => 'Krypto aplikace - Vernamova šifra',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář Vernamovy šifry',
    'annotation' => '
        Vernamova šifra, známá také jako jednorázová tabulková šifra, představuje symetrickou kryptografickou metodu, která využívá exkluzivní logickou operaci XOR (exclusive OR). Základní princip spočívá v tom, že každý znak v plaintextu je kombinován s odpovídajícím znakem v tajném klíči.
        Pro správné použití Vernamovy šifry je klíč generován náhodně a je použit pouze jednou. Důležité je, aby klíč měl stejnou délku jako zpráva, kterou šifrujeme. Klíč může obsahovat libovolné znaky, ale často se pracuje s binárním formátem.
        <br /> <br />
        Šifrování se provádí tak, že každý znak plaintextu je kombinován s odpovídajícím znakem klíče pomocí operace XOR. To znamená, že pokud jsou oba bity stejné, výsledek je nula, v opačném případě je výsledek jednička. 
        Dešifrování probíhá stejným způsobem. Každý znak šifrovaného textu je kombinován s odpovídajícím znakem klíče pomocí XOR operace, což vede k obnovení původního plaintextu.
        <br /> <br />
        Je důležité, aby byl klíč použit pouze jednou a poté byl zničen. Tato procedura zajišťuje vyšší úroveň bezpečnosti tohoto šifrovacího postupu. Vernamova šifra poskytuje vysoký stupeň tajnosti, avšak praktické výzvy, jako je bezpečná distribuce klíčů, mohou omezit její praktické využití ve skutečných aplikacích.
        <br />
        Tato implementace využívá binárních vstupů a poskytuje binární výstup. Pokud je binární klíč příliš krátký pak je doplněn o 0 z levé strany. V případě větší délky je klíč oříznut z levé strany. Kroky algoritmu zobrazují jednotlivé XOR operace nad vstupem.
    ',
    'scheme' => 'Schéma binarního šifrování Vernamovou šifrou',
];
