<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function owner() {
        return $this->belongsTo(Owner::class);
    }

    public function typeVehicle() {
        return $this->belongsTo(TypeVehicle::class);
    }
}
