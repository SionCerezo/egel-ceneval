<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status_catalog';

     /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];

    public function getActionsAttribute(){
        $active   = ['id' => 'active', 'value' => 'Activa'];
        $inactive = ['id' => 'inactive', 'value' => 'Inactiva'];
        $close    = ['id' => 'close', 'value' => 'Cerrada'];
        switch ($this->id) {
            case 'active':
                $actions = collect([$close, $inactive]);
                break;
            case 'inactive':
                $actions = collect([$active]);
                break;
            case 'close':
                $actions = collect([$active, $inactive]);
                break;

            default:
                $actions = collect([]);
                break;
        }

        return $actions;
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
