<?php

namespace App\View\Components;

use Illuminate\View\Component;

trait HtmlTag
{
    public $name;

    public $id;

    /**
     * Construye el valor para el campo id a partir del primer parametro recibido. Si el
     * arg. id es indefinido se regresara el valor de $default o el arg. id en caso contrario.
     *
     * @param string $id El valor para el campo id.
     * @param string $default Un valor para el campo id si el arg. id esta indefinido.
     */
    protected function buildId($id, $default){
        $this->id = isset($id) ? $id : $default;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element');
    }
}
