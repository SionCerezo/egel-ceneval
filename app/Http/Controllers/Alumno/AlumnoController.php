<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Convocatoria;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Services\AlumnoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    public $alumnoService;

    public function __construct(AlumnoService $alumnoService)
    {
        $this->middleware('auth');
        $this->alumnoService = $alumnoService;
    }

    public function home()
    {
        // dd(auth()->user());
        // dd(auth()->user()->fullUser);
        // dd(fullUserAuth());
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

    public function edit($id)
    {
        $alumno = Alumno::find($id);
        $user = User::where('user_id',$alumno->id)->get();
        // dd(auth()->user());
        return view('alumno.update.edit',compact('user'))->with('carreras', Carrera::all()); //se debe retornar la vista y se le pasa el usuario logeado
    }

    public function update(Request $request,$id)
    {
        //buscar al alumno en la bd y empezar a asignar sus datos

        //buscar el usuario en la bd y cambiar el email en caso de que lo haya cambiado

        //redirigirnos al home del alumno

    }
}
