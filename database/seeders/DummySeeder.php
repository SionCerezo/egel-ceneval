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
            'title'=>'Convocatoria Verano 2021',
            'description'=>'Aplicación de examen para el perido 2021',
            'start_date'=> Carbon::now(),
            'end_date'=> Carbon::now()->addMonth(1),
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
            'name'=> 'Carlos',
            'pat_surname'=> 'Palomino',
            'mat_surname'=> 'Jimenez',
            'matricula'=> '123456789',
            'telephone'=> '11 22 33 44 55',
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
            'name'=> 'Sion',
            'pat_surname'=> 'Cerezo',
            'mat_surname'=> 'Juarez',
            'matricula'=> '123456789',
            'telephone'=> '11 22 33 44 55',
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
            'name'=> 'Juan',
            'pat_surname'=> 'Sanchez',
            'mat_surname'=> 'Lopez',
            'matricula'=> '123456789',
            'telephone'=> '11 22 33 44 55',
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
