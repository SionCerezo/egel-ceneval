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
        Carrera::create(['id'=>'icc','nombre'=>'Ingeniería en Ciencias de la Computación'])
            ->save();

        Carrera::create(['id'=>'lcc','nombre'=>'Licenciatura en Ciencias de la Computación'])
            ->save();

        Carrera::create(['id'=>'iti','nombre'=>'Ingeniería en Tecnologías de la Información'])
            ->save();
    }

    private function seedPeriodos()
    {
        PeriodoCatalog::create(['id'=>'primavera','nombre'=>'Primavera'])->save();
        PeriodoCatalog::create(['id'=>'verano','nombre'=>'Verano'])->save();
        PeriodoCatalog::create(['id'=>'otono','nombre'=>'Otoño'])->save();
    }

    private function seedStatus()
    {
        Status::create(['id'=>'active', 'valor'=>'Activa'])->save();
        Status::create(['id'=>'pending', 'valor'=>'Pendiente'])->save();
        Status::create(['id'=>'close', 'valor'=>'Cerrada'])->save();
        // Añadir las que falten ...
    }
}
