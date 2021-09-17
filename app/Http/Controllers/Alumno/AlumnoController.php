<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Convocatoria;
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

        return view('alumno.home')->with('convocatoria', $convocatoria)
                    ->with('isRegistred', $this->alumnoService->isRegistred());
    }

    public function activePostulation()
    {
        $post = $this->alumnoService->getActivePostulation();
        return redirect()
            ->route('postulacion.show', ['postulacion' => $post->id]);
    }
}
