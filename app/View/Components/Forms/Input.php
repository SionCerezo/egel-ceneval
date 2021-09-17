<?php

namespace App\View\Components\Forms;

use App\View\Components\HtmlTag;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class Input extends Component
{
    use HtmlTag;

    public $type;

    public $label;

    /**
     * Create a new Input instance.
     *
     * @return void
     */
    public function __construct($type, $label, $name = null)
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = $this->buildName($name, $label);
    }

    /**
     * Construye el valor para el campo name a partir del primer parametro recibido.
     *
     * @param string $name El valor para el campo name.
     * @param string $default Un valor para el campo name si el arg. name esta indefinido.
     * @return string Si el arg. name es indefinido se regresara el kebab case de $default
     *  o el arg. name en caso contrario.
     */
    protected function buildName($name, $default){
        return isset($name) ? $name : Str::kebab($default);
    }

    /**
     * Verifica si el nombre del elemento en un mesaje de error esta en snake case y lo
     * transforma los guiones en espacios.
     *
     * @param string $msg El mensaje de error a transformar
     * @return string El mensaje de error recibido sin snake case.
     */
    public function errorMessage(String $msg)
    {
        if( $this->name != $this->label ){
            $tmp_name = Str::of($this->name)->replace("_"," ");
            return Str::of($msg)->replaceFirst($tmp_name, $this->label);
        }
        return $msg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
