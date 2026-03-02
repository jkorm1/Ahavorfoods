<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember; // ✅ Correct use statement

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::all(); // ✅ Fetch all team members from the database
        return view('about', compact('teamMembers'));
    }
}
