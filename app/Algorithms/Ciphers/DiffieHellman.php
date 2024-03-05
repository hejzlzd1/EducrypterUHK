<?php

namespace App\Algorithms\Ciphers;

use App\Algorithms\CipherBase;
use App\Algorithms\Output\BasicOutput;
use App\Algorithms\Output\DiffieHellmanOutput;
use App\Algorithms\Output\Steps\NamedStep;
use Exception;
use Faker\Guesser\Name;

class DiffieHellman extends CipherBase
{
    public function __construct(private int $a, private int $b)
    {
        //
    }

    public function generateSecret(): DiffieHellmanOutput
    {
        $a = gmp_init($this->a);
        $b = gmp_init($this->b);
        $base = gmp_init(5);
        $modulus = gmp_init(23);

        $output = new DiffieHellmanOutput(
            base: gmp_intval($base),
            modulus: gmp_intval($modulus),
            a: $this->a,
            b: $this->b
        );
        $publicA = gmp_powm($base, $this->a, $modulus);
        $output->setPublicA(gmp_strval($publicA));
        $output->addStep(
            new NamedStep(
                'A = gᵃ mod p',
                gmp_strval($publicA),
                '<i class="fa-solid fa-eye"></i> ' . trans('diffieHellmanPageTexts.calculatePublicA')
            )
        );

        $publicB = gmp_powm($base, $this->b, $modulus);
        $output->setPublicB(gmp_strval($publicB));
        $output->addStep(
            new NamedStep(
                'B = gᵇ mod p',
                gmp_strval($publicB),
                '<i class="fa-solid fa-eye"></i> ' . trans('diffieHellmanPageTexts.calculatePublicB')
            )
        );

        $output->addStep(
            new NamedStep(
                '-',
                '-',
                '<i class="fa-solid fa-arrow-right-arrow-left"></i>' . trans(
                    'diffieHellmanPageTexts.transferPublicKeys'
                )
            )
        );

        $sA = gmp_powm($publicB, $this->a, $modulus);
        $output->setSecretA(gmp_strval($sA));
        $output->addStep(
            new NamedStep(
                'S = Bᵃ mod p',
                gmp_strval($sA),
                '<i class="fa-solid fa-eye-slash"></i> ' . trans('diffieHellmanPageTexts.calculateSecret')
            )
        );

        $sB = gmp_powm($publicA, $this->b, $modulus);
        $output->setSecretB(gmp_strval($sB));
        $output->addStep(
            new NamedStep(
                'S = Aᵃ mod p',
                gmp_strval($sB),
                '<i class="fa-solid fa-eye-slash"></i> ' . trans('diffieHellmanPageTexts.calculateSecret')
            )
        );

        if (gmp_cmp($sA, $sB) !== 0) {
            throw new Exception(
                sprintf(
                    'Secret generation error, values don\'t match (sA = %s, sB = %s).',
                    gmp_strval($sA),
                    gmp_strval($sB)
                )
            );
        }

        $output->setOutputValue(gmp_strval($sA));
        return $output;
    }
}