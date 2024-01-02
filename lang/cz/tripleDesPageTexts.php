<?php
return [
    'title' => 'Krypto aplikace - Triple DES',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář Triple DES šifry',
    'annotation' => '    
        Triple DES (3DES) je šifrovací algoritmus, který využívá <a href="/simpleDesCipher">Data Encryption Standard (DES)</a> kryptografický standard. DES sám o sobě byl postaven na Feistelově síti, která využívá 56bitové klíče, což může být považováno za nedostatečné pro moderní bezpečnostní standardy. Triple DES přichází jako zlepšená verze DES s cílem zvýšit bezpečnost prostřednictvím vícevrstvého použití DES.
        <br /> <br />
        V Triple DES je průchod DES algoritmem využit třikrát, a to buď v režimu EDE (Encrypt, Decrypt, Encrypt) nebo v režimu EEE (Encrypt, Encrypt, Encrypt). V prvním režimu (EDE) se tři klíče označují jako K1, K2 a K3, přičemž první šifrování je provedeno s klíčem K1, dešifrování s K2 a nakonec znovu šifrování s K3. V režimu EEE jsou všechny tři operace šifrování (klíče se použijí v pořadí). V případě dešifrování jsou operace inverzní.
        <br /> <br />
        Triple DES poskytuje vyšší úroveň bezpečnosti než původní DES a zároveň zachovává kompatibilitu s existujícími systémy, které stále používají DES. Používá se tam, kde je vyžadována větší úroveň bezpečnosti než DES může poskytnout. Díky třem vrstvám šifrování Triple DES lépe odolává kryptoanalytickým útokům, které by mohly ohrozit použití jednoduchého DES. Je vhodný pro bezpečné šifrování při zachování některých výhod původního DES.
        <br /> <br/>
        Tato implementace T-DES je postavena na <a href="/simpleDesCipher">S-DES</a> v rámci zachování jednoduchosti. Jako vstup jsou přijímány dva klíče K1 a K2 - klíč K3 = K1. 
    ',
    'blockSchema' => 'Blokové schéma Triple DES',

];