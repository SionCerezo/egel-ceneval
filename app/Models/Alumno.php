<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Traits\User as IsUser;

class Alumno extends Authenticatable
{
    use HasFactory, Notifiable, IsUser;

    // protected $guard = 'alumno';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pat_surname',
        'mat_surname',
        'matricula',
        // 'email',
        'telephone',
        // 'password',
        'carrera_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'user');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
