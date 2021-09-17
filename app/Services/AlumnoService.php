<?php

namespace App\Services;

class AlumnoService {

    public function isRegistred()
    {
        return $this->getActivePostulation() == null;
    }

    public function getActivePostulation()
    {
        return fullUserAuth()->postulaciones()
                 ->whereRelation('convocatoria', 'convocatorias.status_id','active')
                 ->get()->first();
    }
}
