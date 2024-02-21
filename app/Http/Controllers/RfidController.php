<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfid;
use App\User;

use Illuminate\Support\Facades\DB;

class RfidController extends Controller
{
    public function getRfidTag()
    {
        // Fetch RFID tag from the database or any other source
        $rfidTag = Rfid::pluck('rfid_tag')->last(); // Example: assuming 'rfid_tag' is the column in your table

        return response()->json(['rfid_tag' => $rfidTag]);
    }
    public function storeRfid(Request $request)
    {
        $request->validate([
            'Rfid_tag' => 'required|string|max:255', // Adjust validation rules as needed
        ]);

        $rfid = Rfid::create([
            'Rfid_tag' => $request->input('Rfid_tag'),
        ]);

        return response()->json(['message' => 'RFID tag created successfully', 'rfid' => $rfid], 201);
    }
    public function getAllRFIDTags()
    {
        // Retrieve all RFID tags from the users table
        $rfidTags = User::whereNotNull('rfid_tag')->pluck('rfid_tag')->toArray();

        return response()->json(['rfid_tags' => $rfidTags]);
    }
}
