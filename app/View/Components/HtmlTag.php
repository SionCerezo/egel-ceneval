<?php

namespace App\View\Components;

use Illuminate\View\Component;

trait HtmlTag
{
    /**
     * Represents the 'name' attribute of a tag HTML.
     */
    public $name;

    /**
     * Represents the 'id' attribute of a tag HTML.
     */
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
     * Construye el valor para un atributo verificando si no es nulo, en cuyo caso toma uno de los valores default recibidos.
     *
     * @param string $attr El valor del atributo a evaluar.
     * @param array $defaults una lista de valores default que tomara el atributo si su valor es nulo. Cada item en la lista
     *              puede ser:
     *                  un valor simple
     *                  un array con las keys value y mapper, value indica el valor y mapper una funcion para mapear el valor.
     *              Ej: [ value, [value=>'myval', 'mapper'=>'anyFunction']]
     * @return  Si $attr no es nulo, si regresa este valor;
     *          Si $attr es nulo, se evaluan en orden los items en $defaults regresando el primero no nulo,
     *              si item es un valor simple, se regresa este valor.
     *              si item es un array [value,mapper], el valor regresado sera lo que retorne mapper enviendole value como parametro.
     */
    protected function buildAttr($attr, array $defaults = []){
        if( $attr != null ){
            return $attr;
        }else{
            foreach ($defaults as $value ) {
                if( $value!=null ){
                    if( is_array($value) && method_exists($this, $value['mapper']) ){
                        $mapper = $value['mapper'];
                        $value = $this->$mapper( $value['value'] );
                    }
                    return $value;
                }
            }
        }
        return null;
    }

    public function addOptionalAttr(String $name)
    {
        if( isset($attr) ){
            return "$name=$this->$name";
        }
        return '';
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
