<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license_plate', 'owner_id', 'brand_id', 'type_vehicle_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function typeVehicle()
    {
        return $this->belongsTo(TypeVehicle::class);
    }
}
