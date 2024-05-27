<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class PageController extends Controller
{
    function index()
    {
        $projects = Project::all();
        return view('guests.index',compact('projects'));
    }
}
