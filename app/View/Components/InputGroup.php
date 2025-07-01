<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public string $labelName, $name, $inputType, $placeholder, $isRequired, $icon, $inputOtherAttribute;

    public function __construct($name, $labelName = '', $inputType = 'text', $placeholder = '', $isRequired = true, $icon = '', $inputOtherAttribute = '')
    {
        $this->labelName = $labelName;
        $this->name = $name;
        $this->inputType = $inputType;
        $this->placeholder = $placeholder;
        $this->isRequired = $isRequired;
        $this->icon = $icon;
        $this->inputOtherAttribute = $inputOtherAttribute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-group');
    }
}
