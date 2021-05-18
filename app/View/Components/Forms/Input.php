<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Input extends Component
{

    public $type;
    public $name;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $label, $name = null)
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = isset($name) ? $name : Str::kebab($label);
    }

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
