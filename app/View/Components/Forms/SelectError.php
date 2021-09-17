<?php

namespace App\View\Components\Forms;

use App\View\Components\HtmlTag;
use App\View\Components\LabelableTag;
use Illuminate\View\Component;

class SelectError extends Component
{
    use HtmlTag, LabelableTag;

    public $items;

    public $itemKey;

    public $itemVal;

    /**
     * Create a new Select instance.
     *
     * @return void
     */
    public function __construct($name, $items, $itemKey = 'id',
        $itemVal = 'value', $id = null, $label = null)
    {
        $this->name = $name;
        $this->items =  $items;
        $this->itemKey =  $itemKey;
        $this->itemVal =  $itemVal;
        $this->buildId($id, $name);
        $this->buildLabel($label, $name);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select-error');
    }
}
