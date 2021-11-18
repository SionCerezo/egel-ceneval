<?php

namespace App\View\Components\Forms;

use App\View\Components\HtmlTag;
use App\View\Components\LabelableTag;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\Support\Str;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class Input extends Component
{
    use HtmlTag, LabelableTag;

    /**
     * Represents the 'type' attribute of a tag HTML.
     */
    public $type;

    /**
     * Represents the 'value' attribute of a tag HTML.
     */
    public $value;

    /**
     * List of options to enable the tooltip or error features.
     */
    public $modifiers = ['tooltip' => 'top', 'with-error' => 'bottom'];

    /**
     * Create a new Input instance.
     *
     * @return void
     */
    public function __construct($type, $label = null, $name = null, $id = null, $value = null)
    {
        $this->type = $type;
        $this->value = $value;
        $this->name = $this->buildAttr($name, [$id, ['value'=>$label, 'mapper'=>'labelToName']]);
        $this->id = $this->buildAttr($id, [$name]);
        $this->label = $this->buildAttr($label, [['value'=>$name, 'mapper'=>'nameToLabel']]);
        $this->modifiers = collect($this->modifiers);
    }

    /**
     * Construye el valor para el campo name a partir del primer parametro recibido.
     *
     * @param string $name El valor para el campo name.
     * @param string $defaults Un valor para el campo name si el arg. name esta indefinido.
     * @return string Si el arg. name es indefinido se regresara el kebab case de $defaults
     *  o el arg. name en caso contrario.
     */
    protected function buildName($name, $defaults){
        return $name ?? $defaults['id'] ?? Str::kebab($defaults['label']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $this->extractModifiers($data['attributes'], $this->modifiers);

            return 'components.forms.input';
        };
    }

    /**
     * Extracts each value of modifiers list in the attributes bag. If the modifier is found in the attributes
     * and its value is identical to true, nothing is done leaving the default value in the modifiers list;
     * if the value isn't true, this value is copied in the modifiers list overwritng the previous and removed
     * from the attributes list; if the modifier not found in attributes, the modifier also is removed from the
     * modifiers list.
     *
     * @param AttributesBag $attrs the attributes list from the HTML input.
     * @param \Illuminate\Support\Collection $modifiers the attributes that represnts a modifier of the input.
     */
    private function extractModifiers($attrs, $modifiers){
        foreach( $modifiers->keys()->all() as $modifier ){
            if( Arr::exists($attrs, $modifier) ){
                $attrVal = Arr::pull($attrs, $modifier);
                if( $attrVal!==true )
                    $modifiers->put($modifier, $attrVal);
            }else if( !Arr::has($attrs, $modifier) ){
                $modifiers->pull($modifier);
            }
        }
    }

}
