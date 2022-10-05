<?php
return [
    "annotation" => "Blowfish je symetrická bloková šifra využívaná ve velkém množství šifrovacích produktů. Díky své proměnlivé délce klíče 32-448 bitů je tento algoritmus velice bezpečný.
                    <br/>Jedná se o algoritmus vytvořený jakožto reakce na pomalejší a postarší DES (Data Encryption Standard). Při svém šifrování využívá 64 bitových bloků a 16 \"rund\" Feistelovy funkce.
                    <br/>Jediná nevýhoda spočívá v proměnném šifrovacím klíči - každá změna celý proces zpomaluje. Změn/výpočtů subklíčů se za celý šifrovací cyklus provede 521 což vychází přibližně na 4KB dat.

                    //TODO Přidat teorii - rozepsat",

    "blockSchema" => "Blokové schéma blowfish",
    ];

