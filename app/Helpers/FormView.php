<?php
use Illuminate\Support\Str;

/**
 * Convierte fecha de una instancia de Carbon a un string a partir del formato dado, utilizando la
 * configuracion local.
 *
 * @param Carbon $date El objeto fecha a convertir.
 * @param string $format Formato valido de Carbon para aplicar a la conversion.
 * no se encuentra.
 *
 * @return string La fecha convertida a string.
 */
function parseElementName($date, $format = null){
    if( !isset($format) ){
        $format = property('dates.formats.default');
    }
    return Str::title($date->isoFormat($format));
}
?>
