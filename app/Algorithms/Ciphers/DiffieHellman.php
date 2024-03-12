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
    public function __construct(private int $a, private int $b, private int $modulus, private int $base)
    {
        //
    }

    public function generateSecret(): DiffieHellmanOutput
    {
        $a = gmp_init($this->a);
        $b = gmp_init($this->b);
        $base = gmp_init($this->base);
        $modulus = gmp_init($this->modulus);

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
                sprintf('A = %d<sup>%d</sup> mod %d', $this->base, $this->a, $this->modulus),
                gmp_strval($publicA),
                '<i class="fa-solid fa-eye w-25-px"></i>' . trans('diffieHellmanPageTexts.calculatePublicA') . ' - ' . trans('diffieHellmanPageTexts.userA')
            )
        );

        $publicB = gmp_powm($base, $this->b, $modulus);
        $output->setPublicB(gmp_strval($publicB));
        $output->addStep(
            new NamedStep(
                sprintf('B = %d<sup>%d</sup> mod %d', $this->base, $this->b, $this->modulus),
                gmp_strval($publicB),
                '<i class="fa-solid fa-eye w-25-px"></i>' . trans('diffieHellmanPageTexts.calculatePublicB') . ' - ' . trans('diffieHellmanPageTexts.userB')
            )
        );

        $output->addStep(
            new NamedStep(
                '-',
                '-',
                '<i class="fa-solid fa-arrow-right-arrow-left w-25-px"></i>' . trans(
                    'diffieHellmanPageTexts.transferPublicKeys'
                )
            )
        );

        $sA = gmp_powm($publicB, $this->a, $modulus);
        $output->setSecretA(gmp_strval($sA));
        $output->addStep(
            new NamedStep(
                sprintf('S = %d<sup>%d</sup> mod %d', $publicB, $this->a, $this->modulus),
                gmp_strval($sA),
                '<i class="fa-solid fa-eye-slash w-25-px"></i>' . trans('diffieHellmanPageTexts.calculateSecret') . ' - ' . trans('diffieHellmanPageTexts.userA')
            )
        );

        $sB = gmp_powm($publicA, $this->b, $modulus);
        $output->setSecretB(gmp_strval($sB));
        $output->addStep(
            new NamedStep(
                sprintf('S = %d<sup>%d</sup> mod %d', $publicA, $this->a, $this->modulus),
                gmp_strval($sB),
                '<i class="fa-solid fa-eye-slash w-25-px"></i>' . trans('diffieHellmanPageTexts.calculateSecret') . ' - ' . trans('diffieHellmanPageTexts.userB')
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