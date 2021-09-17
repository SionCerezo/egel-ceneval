<?php

namespace App\View\Components\Forms;

class TopValidInput extends ValidationInput
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $label = null, $id = null, $prepend = false)
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = $this->buildName($name, $label);
        $this->id = $this->buildId($id, $name);
        $this->prepend = $prepend;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.top-valid-input');
    }
}
