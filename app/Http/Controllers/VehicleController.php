<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\EntryRecord;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getAllVehicles()
    {
        return Vehicle::all();
    }

    public function getVehicle($plateNumber)
    {
        $vehicle = Vehicle::where('plate_number', $plateNumber)
                          ->first();
        if ($vehicle) {
            return response()->json([
                'vehicleInfo' => $vehicle,
                'message' => 'All vehicles retrieved successfully'
            ]);
        } else {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
    }


    public function insertGuestEntryRecord(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'owner' => 'required|string',
            'plate_number' => 'required|string',
            'validity' => 'required|string',
            'type' => 'required|string',
        ]);

        try {
            $vehicle = Vehicle::where('plate_number', $validatedData['plate_number'])->first();

            if (!$vehicle) {
                $vehicle = new Vehicle();
                $vehicle->owner = $validatedData['owner'];
                $vehicle->plate_number = $validatedData['plate_number'];
                $vehicle->validity = $validatedData['validity'];
                $vehicle->type = $validatedData['type'];
                $vehicle->validity_date = now()->toDateString(); // Set the validity_date to the current date
                $vehicle->save();
            }

            // Create an entry record based on the plate number
            $entryRecord = new EntryRecord();
            $entryRecord->owner = $validatedData['owner'];
            $entryRecord->vehicle_plate_number = $validatedData['plate_number'];
            $entryRecord->timestamp = now()->toDateTimeString();
            $entryRecord->date = now()->toDateString();
            // Set other properties as needed
            // Save the entry record
            $entryRecord->save();

            // Return a success response
            return response()->json(['message' => 'Entry record created successfully'], 200);
        } catch (\Exception $e) {
            // Log the error

            // Return an error response
            return response()->json(['error' => 'Failed to create entry record'], 500);
        }
    }

    public function insertEntryRecordValid(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'plateNumber' => 'required|string',
        ]);

        // Check if a vehicle with the provided plate number exists
        $vehicle = Vehicle::where('plate_number', $validatedData['plateNumber'])->first();
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        // Create a new entry record based on the plate number
        $entryRecord = new EntryRecord();
        $entryRecord->owner = $vehicle->owner;
        $entryRecord->vehicle_plate_number = $validatedData['plateNumber'];
        $entryRecord->timestamp = now()->toDateTimeString();
        $entryRecord->date = now()->toDateString();
        // Set other properties of the entry record as needed
        // Save the entry record
        $entryRecord->save();

        // Return a success response
        return response()->json(['message' => 'Entry record created successfully'], 200);
    }

    public function getTotalVehicles()
    {
        $totalValidVehicles = Vehicle::where('validity', 'Registered')->count();
        $totalExpiredVehicles = Vehicle::where('validity', 'Expired')->count();
        $totalGuestVehicles = Vehicle::where('validity', 'Guest')->count();

        return response()->json([
            'total_valid_vehicles' => $totalValidVehicles,
            'total_expired_vehicles' => $totalExpiredVehicles,
            'total_guest_vehicles' => $totalGuestVehicles,
        ]);
    }
}
