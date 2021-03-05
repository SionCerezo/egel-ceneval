<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\PeriodoCatalog;
use App\Models\Status;
use Illuminate\Database\Seeder;

class CatalogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedCarreras();
        $this->seedPeriodos();
        $this->seedStatus();
    }

    private function seedCarreras(){
        Carrera::create(['nombre'=>'Ingeniería en Ciencias de la Computación'])
            ->save();

        Carrera::create(['nombre'=>'Licenciatura en Ciencias de la Computación'])
            ->save();

        Carrera::create(['nombre'=>'Ingeniería en Tecnologías de la Información'])
            ->save();
    }

    private function seedPeriodos()
    {
        PeriodoCatalog::create(['nombre'=>'Primavera'])->save();
        PeriodoCatalog::create(['nombre'=>'Verano'])->save();
        PeriodoCatalog::create(['nombre'=>'Otoño'])->save();
    }

    private function seedStatus()
    {
        Status::create(['valor'=>'Activa'])->save();
        Status::create(['valor'=>'Pendiente'])->save();
        Status::create(['valor'=>'Cerrada'])->save();
        // Añadir las que falten ...
    }
}
