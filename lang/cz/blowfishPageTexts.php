<?php

return [
    'title' => 'EduCrypter - Blowfish šifra',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář blowfish šifry',
    'annotation' => 'Blowfish je bloková šifra se symetrickým klíčem, kterou v roce 1993 navrhl Bruce Schneier. Jedná se o rychlý, poměrně bezpečný šifrovací algoritmus, který se využíval v různých aplikacích, včetně elektronického obchodování, virtuálních privátních sítí (VPN) a ukládání hesel.
                       <br/><br/>
Blowfish používá klíč proměnné délky, od 32 do 448 bitů, a pracuje s 64bitovými bloky otevřeného textu. Klíč se používá k inicializaci sady dílčích klíčů, které se používají v sérii 16 rund šifrování a dešifrování.
<br/><br/>
Dílčí klíče jsou odvozeny z hlavního klíče pomocí algoritmu plánování klíčů, který se skládá z řady operací, které míchají bity klíče a vytvářejí dílčí klíče. Algoritmus plánování klíče používá k míchání bitů klíče a vytváření dílčích klíčů řadu S-boxů, což jsou předem vypočtené tabulky substitučních hodnot.
<br/><br/>
Každá runda procesu šifrování a dešifrování se skládá ze tří operací: operace XOR s dílčím klíčem, provedení rundovní funkce nad výsledkem předchozího kroku, XOR pravé části bloku s výsledkem rundovní funkce a prohození levé a pravé poloviny bloku (vlevo XOR, vpravo rundovní funkce + XOR).
<br/><br/>
Jednou z klíčových vlastností šifry Blowfish je její škálovatelnost. Klíč s proměnnou délkou umožňuje různé úrovně zabezpečení v závislosti na délce použitého klíče. Šifra Blowfish je také navržena tak, aby byla rychlá a efektivní, takže je vhodná pro použití v aplikacích, které vyžadují vysokou rychlost šifrování a dešifrování.
<br/><br/>
Navzdory svému stáří zůstává Blowfish oblíbeným šifrovacím algoritmem. Kryptografové jej důkladně studovali a analyzovali, a v jeho návrhu nebyly nalezeny žádné závažné nedostatky. Nedoporučuje se však používat v nových aplikacích, protože byl z velké části nahrazen novějšími algoritmy, jako je například Twofish.
',
    'blockSchema' => 'Blokové schéma blowfish',
    'leftInput' => 'Levý blok',
    'rightInput' => 'Pravý blok',
    'leftBlockXorOutput' => 'Levý blok XOR subklíč',
    'rightBlockFeistelOutput' => 'Výstup rundovní funkce',
    'rightBlockXorOutput' => 'F funkce XOR pravý blok',
    'rightBlockXorKeyOutput' => 'Pravý blok XOR subklíč',
];
