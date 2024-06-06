<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Helpers as Help;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$projects = Project::all();
        $projects = Project::paginate(5);
        foreach ($projects as $project) {
            $project->programming_languages = Help::getFormattedWordsWithComma($project->programming_languages);
            $project->frameworks = Help::getFormattedWordsWithComma($project->frameworks);
        }
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.create", compact("types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $form_data["slug"] =  Project::generateSlug($form_data["title"]);
        if ($request->hasFile('image_url')) {
            $img_path = Storage::put('my_images', $request->image_url);
            $form_data['image_url'] = $img_path;
        }
        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project->save();
        if ($request->has('technologies')) {
            $new_project->technologies()->attach($request->technologies);
        }
        return redirect()->route("admin.projects.index");
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $types = Type::all();
        $technologies = Type::all();
        $project = Project::where('slug', $slug)->firstOrFail();
        return view("admin.projects.edit", compact("project",  "types", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $slug)
    {

        $project = Project::where('slug', $slug)->firstOrFail();
        $form_data = $request->validated();
        if ($project->title != $form_data["title"]) {
            $form_data["slug"] =  Project::generateSlug($form_data["title"]);
        }
        if ($request->hasFile('image_url')) {
            if ($project->image_url) {
                Storage::delete($project->image_url);
            }
            $img_path = Storage::put('my_images', $request->image_url);
            $form_data['image_url'] = $img_path;
        }
        $project->fill($form_data);
        $project->update();
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);
        }
        return redirect()->route("admin.projects.index")->with('message', "Project (id:{$project->id}): {$project->title} modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        //$project->technologies()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Project (id:{$project->id}): {$project->title} eliminato con successo");
    }
}
