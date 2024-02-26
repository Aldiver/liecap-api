<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getAllVehicles()
    {
        return Vehicle::all();
    }

    public function getVehicle($plateNumber)
    {
        $vehicle = Vehicle::where('plate_number', $plateNumber)->first();
        if ($vehicle) {
            return response()->json($vehicle);
        } else {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
    }
}
