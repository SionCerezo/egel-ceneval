<?php
use App\Helpers\PropertyHelpers;

/**
 * Obtiene el valor de una variable especificada en el folder de configuracion 'config/properties'.
 *
 * @param string $prop_name El nombre de la propiedad en sintaxis punto (dot syntax).
 * @param mixed $default_value Un valor por default a devolver si el nombre de la propiedad
 * no se encuentra.
 *
 * @return mixed El valor de la variable que coincide con $prop_name en el archivo de configuracion
 * especificado.
 */
function property($prop_name, $default_value = null){
    return PropertyHelpers::get($prop_name, $default_value);
}
?>
