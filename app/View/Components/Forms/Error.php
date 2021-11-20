<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Error extends Component
{
    public $elementName;

    public $elementLabel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elementName, $elementLabel=null)
    {
        $this->elementName = $elementName;
        $this->elementLabel = $elementLabel ?? $elementName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.error');
    }

    /**
     * Verifica si el atributo name de un elemento Html en un mesaje de error esta en snake case
     * y transforma los guiones en espacios.
     *
     * @param string $msg El mensaje de error a transformar
     * @return string El mensaje de error recibido sin snake case.
     */
    public function buildMessage(String $msg)
    {
        if( $this->elementName != $this->elementLabel ){
            $name = Str::of($this->elementName)->replace("-"," ")->replace("_", " ");
            return Str::of($msg)->replaceFirst($name, $this->elementLabel);
        }
        return $msg;
    }
}
