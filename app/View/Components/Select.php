<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public  $name,
        $label,
        $isRequired,
        $addons;

    public function __construct($name = '', $label = '', $isRequired = false, $placeholder = '', $addons = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->isRequired = $isRequired;
        $this->addons = $addons;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
