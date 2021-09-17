<?php

namespace App\View\Components\Forms;

use App\View\Components\HtmlTag;
use App\View\Components\LabelableTag;

class InputError extends Input
{
    use HtmlTag, LabelableTag;

    public $prepend;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $label = null, $id = null, $prepend = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->buildLabel($label, $name);
        $this->buildId($id, $name);
        $this->prepend = $prepend;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-error');
    }
}
