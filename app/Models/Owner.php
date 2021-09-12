<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'document_id'
    ];

    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }
}
