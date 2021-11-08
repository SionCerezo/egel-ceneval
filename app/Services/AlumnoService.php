<?php

namespace App\Services;

use App\Models\Convocatoria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AlumnoService {

    public function isRegistred($convocatoria)
    {
        return $this->getActivePostulation($convocatoria) != null;
    }

    public function getActivePostulation($convocatoria = null)
    {
        if( $convocatoria == null )
            $convocatoria = $this->getActiveConvocatoria();

        return optional( $convocatoria->postulaciones() )
            ->whereHas('alumno', function(Builder $query){
                $query->where('id', fullUserAuth()->id);
            })->first();
        // return fullUserAuth()->postulaciones()
        //          ->whereRelation('convocatoria', 'convocatorias.status_id','active')
        //          ->get()->first();
    }

    private function getActiveConvocatoria(){
        return Convocatoria::where('status_id','active')
            ->orderByDesc('created_at')->first();
    }
}
