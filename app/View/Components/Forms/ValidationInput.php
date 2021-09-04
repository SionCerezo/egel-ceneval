<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Str;

class ValidationInput extends Input
{
    public $id;

    public $prepend;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $label = null, $id = null, $prepend = false)
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = isset($name) ? $name : Str::kebab($label);
        $this->id = isset($id) ? $id : $name;
        $this->prepend = $prepend;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.validation-input');
    }
}
