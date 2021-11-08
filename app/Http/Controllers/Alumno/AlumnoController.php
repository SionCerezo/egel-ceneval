<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Convocatoria;
use App\Models\Postulacion;
use App\Services\AlumnoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    public $alumnoService;

    public function __construct(AlumnoService $alumnoService)
    {
        $this->alumnoService = $alumnoService;
    }

    public function home()
    {
        $convocatoria = Convocatoria::where('status_id','active')
            ->orderByDesc('created_at')->limit(1)->first();

        $registred = $this->alumnoService->isRegistred($convocatoria);

        return view('alumno.home')->with('convocatoria', $convocatoria)
                    ->with('isRegistred', $registred);
    }

    public function activePostulation()
    {
        $postulacion = $this->alumnoService->getActivePostulation();

        return view("alumno.postulacion.show")->with('postulacion', $postulacion)
                ->with('files', optional($postulacion)->files);
    }
}
