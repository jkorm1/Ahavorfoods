<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::all();
        return view('about', compact('teamMembers'));
    }
}
