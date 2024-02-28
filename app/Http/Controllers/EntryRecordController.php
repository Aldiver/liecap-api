<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntryRecord;

class EntryRecordController extends Controller
{
    public function getAllEntries()
    {
        return EntryRecord::latest()->get();
    }
}
