<?php

namespace App\Services;

use App\Models\Convocatoria;

class PostulacionService {

    public function getCurrents()
    {
        $activeConvocatoria = Convocatoria::where('status_id','active')
            ->orderByDesc('created_at')->first();

        return $activeConvocatoria == null ? collect() : $activeConvocatoria->postulaciones;
    }
}
