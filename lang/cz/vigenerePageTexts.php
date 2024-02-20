<?php

return [
    'title' => 'Krypto aplikace - Vigenèrova šifra',
    'metaComment' => 'Tato stránka obsahuje popis a zkušební formulář vigenère šifry',
    'annotation' => 'Tato monoalfabetická substituční šifra funguje na základě Caesarovy šifry. K aplikování tohoto algoritmu se využívá všech kombinací Caesarovy abecedy (tj. 26 kombinací) poskládaných do tabulky souřadnic.
                     <br /> <br />Dle klíče a původního textu se následně vybírá sloupec a řádek v tabulce abeced (klíč je stejně dlouhý jako otevřený text, jinak se musí opakovat do dané délky) - znakem na dané pozici v tabulce se nahradí původní znak.',
    'table' => 'Vigenèrova tabulka',
];
