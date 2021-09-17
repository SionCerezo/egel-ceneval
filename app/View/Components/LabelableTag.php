<?php

namespace App\View\Components;

use Illuminate\Support\Str;

trait LabelableTag
{
    public $label;

    /**
     * Construye el valor para el campo label a partir del primer parametro recibido. Si el arg.
     * label es indefinido regresara el valor de $elemName con espacios en lugar de '-' y '_'.
     *
     * @param string $label El valor para el campo label.
     * @param string $elemName El valor del attr name de la etiqueta Html de este label.
     */
    protected function buildLabel($label, $elemName){
        if( isset($label) ){
            $this->label = $label;
        }else{
            $tmp_name = Str::of($elemName)->replace("-"," ")->replace("_", " ");
            $this->label = Str::ucfirst($tmp_name);
        }
    }
}
