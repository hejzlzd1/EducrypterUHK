<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Simple copy button component
 * Accepts text that should be copied
 */
class CopyButton extends Component
{
    public function __construct(
        public string $textToCopy,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.copyButton');
    }
}
