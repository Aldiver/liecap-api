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
                          ->where('validity', '!=', 'Guest')
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
                // Create a new Vehicle instance
                $vehicle = Vehicle::create($validatedData);
            }

            // Create an entry record based on the plate number
            $entryRecord = new EntryRecord();
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
        $entryRecord->vehicle_plate_number = $validatedData['plateNumber'];
        $entryRecord->timestamp = now()->toDateTimeString();
        $entryRecord->date = now()->toDateString();
        // Set other properties of the entry record as needed
        // Save the entry record
        $entryRecord->save();

        // Return a success response
        return response()->json(['message' => 'Entry record created successfully'], 200);
    }
}
