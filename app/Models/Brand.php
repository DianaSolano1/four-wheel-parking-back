<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }
}
