<?php
return [
    "title" => "Krypto aplikace - Blowfish šifra",
    "metaComment" => "Tato stránka obsahuje popis a zkušební formulář blowfish šifry",
    "annotation" => "Blowfish je bloková šifra se symetrickým klíčem, kterou v roce 1993 navrhl Bruce Schneier. Jedná se o rychlý, bezpečný a široce používaný šifrovací algoritmus, který je vhodný pro použití v různých aplikacích, včetně elektronického obchodování, virtuálních privátních sítí (VPN) a ukládání hesel.
                       <br/><br/>
Blowfish používá klíč proměnné délky, od 32 do 448 bitů, a pracuje s 64bitovými bloky otevřeného textu. Klíč se používá k inicializaci sady dílčích klíčů, které se používají v sérii 16 kol šifrování a dešifrování.
<br/><br/>
Dílčí klíče jsou odvozeny z klíče pomocí algoritmu plánování klíčů, který se skládá z řady operací, které míchají bity klíče a vytvářejí dílčí klíče. Algoritmus plánování klíče používá k míchání bitů klíče a vytváření dílčích klíčů řadu S-boxů, což jsou předem vypočtené tabulky substitučních hodnot.
<br/><br/>
Každé kolo procesu šifrování a dešifrování se skládá ze čtyř operací: substituční operace, operace permutace, operace XOR s dílčím klíčem a prohození levé a pravé poloviny bloku. Operace substituce využívá S-boxů k nahrazení bloků otevřeného textu různými hodnotami, zatímco operace permutace přehazuje bity bloku.
<br/><br/>
Operace XOR s podklíčem se používá k tomu, aby se do procesu šifrování vnesl zmatek a ztížila se jeho analýza. Prohození levé a pravé poloviny bloku se používá k vytvoření Feistelovy struktury, což je běžný návrhový vzor používaný v blokových šifrách k vytvoření reverzibilní transformace.
<br/><br/>
Jednou z klíčových vlastností šifry Blowfish je její škálovatelnost. Klíč s proměnnou délkou umožňuje různé úrovně zabezpečení v závislosti na délce použitého klíče. Šifra Blowfish je také navržena tak, aby byla rychlá a efektivní, takže je vhodná pro použití v aplikacích, které vyžadují vysokou rychlost šifrování a dešifrování.
<br/><br/>
Navzdory svému stáří zůstává Blowfish oblíbeným a široce používaným šifrovacím algoritmem. Kryptografové jej důkladně studovali a analyzovali a v jeho návrhu nebyly nalezeny žádné závažné nedostatky. Nedoporučuje se však používat v nových aplikacích, protože byl z velké části nahrazen novějšími algoritmy, jako je AES (Advanced Encryption Standard).
",

    "blockSchema" => "Blokové schéma blowfish",
    ];

