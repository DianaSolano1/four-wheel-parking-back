<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }
}
