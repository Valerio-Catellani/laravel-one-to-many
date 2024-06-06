<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.types.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3'
        ], [
            'title.required' => 'The field :attribute is required.',
            'title.max' => 'The field :attribute must be no more than 255 characters.',
            'title.min' => 'The field :attribute must be at least 3 characters.',
        ]);
        $validated["slug"] =  Type::generateSlug($validated["name"]);
        $new_type = new Type();
        $new_type->fill($validated);
        $new_type->save();
        return redirect()->route("admin.types.index");
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        $technologies = Technology::all();
        return view("admin.types.show", compact("type", "technologies"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view("admin.types.edit", compact("type"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'name' => 'required|max:255|min:3'
        ], [
            'title.required' => 'The field :attribute is required.',
            'title.max' => 'The field :attribute must be no more than 255 characters.',
            'title.min' => 'The field :attribute must be at least 3 characters.',
        ]);
        if ($type->name != $validated["name"]) {
            $validated["slug"] =  Type::generateSlug($validated["name"]);
        }
        $type->fill($validated);
        $type->update();
        return redirect()->route("admin.types.index")->with('message', "Type (id:{$type->id}): {$type->name} modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        $type->delete();
        return redirect()->route('admin.types.index')->with('message', "Type (id:{$type->id}): {$type->name} eliminato con successo");
    }
}
