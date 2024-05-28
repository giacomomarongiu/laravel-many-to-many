<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.technologies.index', ['technologies' => Technology::orderByDesc('id')->paginate(10)], compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*  $projects= Project::all();
         return view('admin.technologies.create', compact('projects')); */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        //dd($request->all());
        //Validation
        $val_data = $request->validated();

        //Creating a slug content
        $slug = Str::slug($request->name, '-');
        $val_data['slug'] = $slug;



        //Creating new istance
        $project = Technology::create($val_data);

        if ($request->has('projects')) {
            $project->projects()->attach($val_data['projects']);
        }

        $projects = Project::all();

        return to_route('admin.technologies.index', compact('projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $projects = Project::all();

        return view('admin.technologies.edit', compact('technology', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->validated();
        //slug
        $slug = Str::slug($request->name, '-');
        $val_data['slug'] = $slug;

        if ($request->has('projects')) {
            $technology->projects()->sync($val_data['projects']);
        }

        //update my istance
        $technology->update($val_data);
        return to_route('admin.technologies.index', $technology);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', 'Technology deleted successfully');
    }
}
