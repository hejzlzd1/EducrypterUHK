<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Simple generate button component
 * Accepts type
 */
class GenerateInputButton extends Component
{
    public const int TYPE_TEXT = 1,
    TYPE_NUMBER = 2,
    TYPE_BINARY = 3,
    TYPE_PRIME = 4,
    TYPE_PRIMITIVE_ROOT = 5;
    public function __construct(
        public int $type,
        public int $size,
        public string $target,
        public ?string $inputValueFrom = null,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.generateInputButton');
    }
}
