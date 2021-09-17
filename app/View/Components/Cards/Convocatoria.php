<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Convocatoria extends Component
{
    public $convocatoria;
    /**
     * Create a new convocatoria instance.
     *
     * @return void
     */
    public function __construct($convocatoria)
    {
        $this->convocatoria = $convocatoria;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.convocatoria');
    }
}
