<?php
return [
    'title' => 'Educrypter - Triple DES',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář Triple DES šifry',
    'annotation' => '
        Triple DES (3-DES) je šifrovací algoritmus, který využívá <a href="/simpleDesCipher">Data Encryption Standard (DES)</a>. DES sám o sobě byl postaven na Feistelově síti, která využívá 56bitové klíče, což může být považováno za nedostatečné pro moderní bezpečnostní standardy. Triple DES přichází jako zlepšená verze DES s cílem zvýšit bezpečnost prostřednictvím vícevrstvého použití DES.
        <br /> <br />
        V Triple DES je průchod DES algoritmem využit třikrát, a to buď v režimu EDE (Encrypt, Decrypt, Encrypt) nebo v režimu EEE (Encrypt, Encrypt, Encrypt). V prvním režimu (EDE) se tři klíče označují jako K1, K2 a K3, přičemž první šifrování je provedeno s K1, dešifrování s K2 a nakonec znovu šifrování s K3. V režimu EEE jsou všechny tři operace šifrování (klíče se použijí v pořadí K1, K2, K3). V případě dešifrování se používají operace a klíče v opačném pořadí tzn. DED (Decrypt, Encrypt, Decrypt).
        <br /> <br />
        Triple DES poskytuje vyšší úroveň bezpečnosti než původní DES a zároveň zachovává kompatibilitu s existujícími systémy, které stále používají DES. Používá se tam, kde je vyžadována větší úroveň bezpečnosti než může poskytnout DES. Díky třem vrstvám šifrování Triple DES lépe odolává kryptoanalytickým útokům, které by mohly ohrozit použití jednoduchého DES. Je vhodný pro bezpečné šifrování při zachování některých výhod původního DES.
        <br /> <br/>
        Tato implementace 3-DES je postavena na <a href="/simpleDesCipher">S-DES</a> z edukačních důvodů, jelikož využití této implementace umožňuje lépe proniknout do struktury a fungování 3-DES. Jako vstup jsou přijímány tři klíče K1, K2 a K3, což vede v případě plného algoritmu k dostatečné úrovni zabezpečení.
    ',
    'blockSchema' => 'Blokové schéma Triple DES',

];
