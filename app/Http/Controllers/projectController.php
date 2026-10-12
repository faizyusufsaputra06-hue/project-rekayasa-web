<?php

namespace App\Http\Controllers;

use App\Models\project;

class projectController extends Controller
{
    //
    public function index()
    {
        $projects = project::paginate(6);
        return view('page.projects', compact('projects'));
    }
    
    public function show($id)
    {
        $project = project::findOrFail($id);
        return view('page.project-detail', compact('project'));
    }   
}
