<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Alumno;
use App\Models\Colaborador;
use App\Models\Convocatoria;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $this->seedAdmins();
        $this->seedAlumnos();
        $this->seedColaboradores();
        $this->seedPeriodos();
        $this->seedConvocatorias();
    }

    private function seedConvocatorias(){
        Convocatoria::create([
            'titulo'=>'Convocatoria Verano 2021',
            'descripcion'=>'Aplicación de examen para el perido 2021',
            'fecha_inicio'=> Carbon::now(),
            'fecha_fin'=> Carbon::now()->addMonth(1),
            'periodo_id' => DB::table('periodos')->select('id')->limit(1)->get()->first()->id,
            'status_id' => 'active',
            'create_user_id' => Colaborador::first()->id,
            'create_user_type' => Colaborador::class,
        ]);
    }

    private function seedPeriodos(){
        DB::table('periodos')->insert([
            'periodo_id' => 'verano',
            'year' => '2021',
        ]);
    }

    private function seedAdmins()
    {
        DB::table('admins')->delete();

        $alumno = Admin::create([
            'nombre'=> 'Carlos',
            'ap_paterno'=> 'Palomino',
            'ap_materno'=> 'Jimenez',
            'matricula'=> '123456789',
            'telefono'=> '11 22 33 44 55',
        ]);

        $password = '123123123';
        $alumno->user()->create([
            'email'=> 'carlos@mail.com',
            'password'=> Hash::make($password),
            'pass_decifrada'=> $password,
        ]);
    }

    private function seedAlumnos()
    {
        DB::table('alumnos')->delete();

        $alumno = Alumno::create([
            'nombre'=> 'Sion',
            'ap_paterno'=> 'Cerezo',
            'ap_materno'=> 'Juarez',
            'matricula'=> '123456789',
            'telefono'=> '11 22 33 44 55',
            'carrera_id'=> 'icc',
        ]);

        $password = '123123123';
        $alumno->user()->create([
            'email'=> 'sion@gmail.com',
            'password'=> Hash::make($password),
            'pass_decifrada'=> $password,
        ]);
    }

    private function seedColaboradores()
    {
        DB::table('colaboradores')->delete();

        $colaborador = Colaborador::create([
            'nombre'=> 'Juan',
            'ap_paterno'=> 'Sanchez',
            'ap_materno'=> 'Lopez',
            'matricula'=> '123456789',
            'telefono'=> '11 22 33 44 55',
            'carrera_id'=> 'lcc',
        ]);

        $password = '123123123';
        $colaborador->user()->create([
            'email'=> 'juan@mail.com',
            'password'=> Hash::make($password),
            'pass_decifrada'=> $password,
        ]);
    }
}
