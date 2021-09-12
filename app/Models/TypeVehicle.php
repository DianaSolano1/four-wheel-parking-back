<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }
}