<?php

namespace App\Http\Controllers\Alumno\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\User;
use App\Rules\AlphaSpace;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(){
        return view('auth.register')->with('carreras', Carrera::all());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = Arr::dot(property('rules.alumno'));
        return Validator::make($data, [
            'name'        => ['required', new AlphaSpace, 'max:'.$rules['nombre.max']],
            'pat_surname' => ['required', new AlphaSpace, 'max:'.$rules['ap_paterno.max']],
            'mat_surname' => ['required', new AlphaSpace, 'max:'.$rules['ap_materno.max']],
            'matricula'   => ['required', 'digits_between:1,'.$rules['matricula.max'], 'unique:alumnos'],
            'email'       => ['required', 'string', 'email', 'max:'.$rules['email.max'], 'unique:users'],
            'telephone'   => ['required', 'string', 'max:'.$rules['telefono.max']],
            'password'    => ['required', 'string', 'min:8', 'max:'.$rules['password.max'], 'confirmed'],
            'carrera_id'  => ['required', 'exists:carreras_catalog,id'],
        ]);
    }

    /**
     * Create a new student instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Alumno
     */
    protected function create(array $data)
    {
        try {
            DB::beginTransaction();

            $alumno = Alumno::create([
                'name'        => $data['name'],
                'pat_surname' => $data['pat_surname'],
                'mat_surname' => $data['mat_surname'],
                'matricula'   => $data['matricula'],
                'telephone'   => $data['telephone'],
                'carrera_id'  => $data['carrera_id'],
            ]);

            $user = User::create([
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'user_type' => Alumno::class,
                'user_id'   => $alumno->id,
                // borrar esta validacion
                'pass_decifrada' => $data['password'],
            ]);

            DB::commit();
        } catch (QueryException $th) {
            DB::rollback();
            throw $th;
        }

        return $user;
    }
}
