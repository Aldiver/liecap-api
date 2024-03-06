<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntryRecord;
use Carbon\Carbon;

class EntryRecordController extends Controller
{
    public function getAllEntries()
    {
        return EntryRecord::latest()->get();
    }

    public function getTotalEntryRecords()
    {
        $today = Carbon::today();
        $totalEntryRecords = EntryRecord::whereDate('created_at', $today)->count();

        return response()->json([
            'total_entry_records_today' => $totalEntryRecords,
        ]);
    }
}
