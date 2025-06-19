<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public  $name,
            $label,
            $type,
            $isRequired;

    public function __construct($name = '', $label = '', $type = "text", $isRequired = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->isRequired = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
