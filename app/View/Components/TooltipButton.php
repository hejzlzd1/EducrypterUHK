<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Simple tooltip button component
 * Accepts text that should be shown on hover
 */
class TooltipButton extends Component
{
    public function __construct(
        public string $tooltip,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.tooltipButton');
    }
}
