<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;


    public function periodoCatalog(){
        return $this->belongsTo(PeriodoCatalog::class, 'periodo_id');
    }

    public function getNameAttribute()
    {
        return $this->periodoCatalog->name;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['year', 'periodo_id'];
}
