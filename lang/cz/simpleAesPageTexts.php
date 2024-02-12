<?php

return [
    'title' => 'Krypto aplikace - Simplified AES',
    'annotation' => 'Simplified AES (Advanced Encryption Standard) je zjednodušená verze algoritmu AES navržená pro výukové účely. Algoritmus AES je široce používaný symetrický šifrovací standard, který je přijat vládou Spojených států a běžně používaný po celém světě k šifrování citlivých dat.
        Ve zjednodušeném AES jsou obvykle použity menší blokové a klíčové velikosti (16-bitů) ve srovnání s plnou verzí AES (128, 192 či 256 bitů). Zahrnuje také méně rund - tj. substitucí, prohození řádků matice, kombinování sloupců.
        <br /><br />
        Generování rundovních klíčů probíhá pomocí několika operací. Mezi hlavní prováděné operace patří bitový XOR, substituce bitů pomocí s-box hodnot či prohazování bitových řetězců. Výsledky operací se následně spojí a vytvoří rundovní klíče.
        <br /><br />
        V počáteční rundě je vstupní text kombinován s počátečním klíčem rundy pomocí jednoduché operace XOR. Následují hlavní rundy algoritmu 1x v S-AES. V AES je tato runda opakována 9x, 11x či 13x (dle délky klíče), které obvykle zahrnují sekvenci operací substitucí, prohození řádků matice a kombinování sloupců (v poslední rundě přeskočeno - postup lze najít pod pojmem "Rijndael MixColumns"). V zjednodušeném AES jsou tyto operace značně zjednodušeny, aby byly snazší k pochopení a implementaci. Ve srovnání s původním algoritmem AES jsou operace prováděny na menším datovém vstupu, což značně zjednodušuje postup algoritmu.
        Na konci každé rundy je datový výstup zkombinován s klíčem rundy pomocí operace XOR.
        <br /><br />
        Dešifrování v zjednodušeném AES zahrnuje obrácení šifrovacích kroků. Toto platí i pro použití rundovních klíčů - tzn. rundovní klíče se využijí v obráceném pořadí K2 -> K1 -> K0
        <br /><br />
        Je důležité brát v potaz, že zjednodušený AES se primárně používá pro vzdělávací účely k pochopení základních principů algoritmu AES. V reálném nasazení je v rámci bezpečnosti potřeba využít nezjednodušené alternativy s dostatečnou délkou bitového klíče.
    ',
    'metaComment' => 'Tato stránka obsahuje informace k zjednodušené verzi AES a zkušební formulář',
    'additionalSchemas' => 'Doplňující schémata',
    'blockSchema' => 'Blokové schéma',
    'binaryInput' => 'Binární vstup (16 bitů)',
    'binaryKey' => 'Binární klíč (16 bitů)',
    'keyGeneration' => 'Generování rundovních klíčů',
    'addRoundKey' => 'Uložení klíče',
    'splitKey' => 'Rozdělení zadaného klíče na dvě části (8 bitů)',
    'rotateKey' => 'Prohození částí klíče',
    'substituteNibbles' => 'Nahrazení po 4 bitech pomocí s-boxu',
    'inverseSubstituteNibbles' => 'Nahrazení po 4 bitech pomocí inverzního s-boxu',
    'shiftRow' => 'Prohození S₀₁ s S₁₁',
    'encryptMixNibbles' => 'Pronásobení (S₀₀, S₀₁, S₁₀, S₁₁) s (1, 4, 4, 1) - Galois multiplication',
    'decryptMixNibbles' => 'Pronásobení (S₀₀, S₀₁, S₁₀, S₁₁) s (9, 2, 2, 9) - Galois multiplication',
    'startOfRound' => 'Začátek rundy',
    'endOfRound' => 'Konec rundy',
    'sbox' => 'S-box',
    'sboxInverse' => 'S-box⁻¹',
];
