<?php

namespace App\View\Components;

use Illuminate\Support\Str;

trait LabelableTag
{
    /**
     * Define a tag name understandable to te user. Doesn't a tag attribute.
     */
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

    /**
     * Transform the label in user case to kebab case.
     */
    protected function labelToName($label){
        return Str::kebab($label);
    }

    /**
     * Transform the name in kebab or snake case to user case (spaces between the words) and with the first letter in capital.
     */
    protected function nameToLabel($name){
        $tmp_name = Str::of($name)->replace("-"," ")->replace("_", " ");
        return Str::ucfirst($tmp_name);
    }
}
