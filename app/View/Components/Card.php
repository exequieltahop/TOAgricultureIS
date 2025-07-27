<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */

    // public var
    public $iconType, $cardTitle, $addons;

    // construct
    public function __construct($iconType = '', $cardTitle = '', $addons = '')
    {
        // asign values
        $this->iconType = $iconType;
        $this->cardTitle = $cardTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
