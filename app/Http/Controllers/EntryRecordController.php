<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryRecordController extends Controller
{
    public function getAllEntries()
    {
        return EntryRecord::all();
    }
}
