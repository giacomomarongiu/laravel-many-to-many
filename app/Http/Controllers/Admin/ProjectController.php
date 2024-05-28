<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Project::all());
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());
        //Validation
        $val_data = $request->validated();

        //Creating a slug content
        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;

        //Checking if there is an img
        if ($request->has('img')) {
            //Uploading img
            $img_path = Storage::put('uploads', $val_data['img']);
            // Path assigned at my istance
            $val_data['img'] = $img_path;
        }


        //Creating new istance
        $project=Project::create($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }
        
        return to_route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //dd($project)
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());
        //Validation
        $val_data = $request->validated();
        //slug
        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;

        // Checking if in my request there is an img
        if ($request->has('img')) {
            //Checking if there is already an img and deleting it
            if ($project->img) {
                Storage::delete($project->img);
            }
            //path to my istance
            $img_path = Storage::put('uploads', $val_data['img']);
            $val_data['img'] = $img_path;
        }

        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        }

        //dd($val_data);
        //update my istance
        $project->update($val_data);
        return to_route('admin.projects.index', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //$project->tags()->detach();
        $project->technologies()->detach();

        //If i do not do this my istance in deleted but my file will remain in my storage
        if ($project->img) {
            //Method delete for remove file from storage
            Storage::delete($project->img);
        }
        ;
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully');
    }
}
