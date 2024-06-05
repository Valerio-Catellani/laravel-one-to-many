<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Helpers as Help;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
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
        $categories = Category::all();
        return view("admin.projects.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //     dd($request->validated());
        $form_data = $request->validated();
        $form_data["slug"] =  Project::generateSlug($form_data["title"]);
        if ($request->hasFile('image_url')) {
            $img_path = Storage::put('my_images', $request->image_url);
            $form_data['image_url'] = $img_path;
        }
        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project->save();
        return redirect()->route("admin.projects.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        return view("admin.projects.edit", compact("project",  "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project_to_change =  Project::findOrFail($id);
        $form_data = $request->validated();
        if ($project_to_change->title != $form_data["title"]) {
            $form_data["slug"] =  Project::generateSlug($form_data["title"]);
        }
        if ($request->hasFile('image_url')) {
            if ($project_to_change->image_url) {
                Storage::delete($project_to_change->image_url);
            }
            $img_path = Storage::put('my_images', $request->image_url);
            $form_data['image_url'] = $img_path;
        }
        $project_to_change->fill($form_data);
        $project_to_change->update();
        return redirect()->route("admin.projects.index")->with('message', "Project (id:{$project_to_change->id}): {$project_to_change->title} modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Project (id:{$project->id}): {$project->title} eliminato con successo");
    }
}
