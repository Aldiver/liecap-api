<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'timestamp', 'vehicle_plate_number', 'date'
    ];
}
