<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner', 'plate_number', 'validity', 'validity_date', 'type'
    ];

    public function entryRecords()
    {
    return $this->hasMany(EntryRecord::class, 'vehicle_plate_number', 'plate_number');
    }
}

