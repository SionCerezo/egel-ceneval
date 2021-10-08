<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Item extends Component
{
    public $href;
    public $dataFeather;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href='',$dataFeather='')
    {
        $this->href = $href;
        $this->dataFeather = $dataFeather;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item');
    }
}
