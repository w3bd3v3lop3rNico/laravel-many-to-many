<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $query = Project::limit(20);

        if (isset($data['title'])) {
            $query = $query->where('title', 'like', "%{$data['title']}%")->limit(20);
        }

        $projects = $query->get();

        return view("admin.projects.index", compact("projects"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::orderBy('name', 'ASC')->get();

        return view('admin.projects.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|string|unique:projects',
            'description' => 'nullable|min:5|string',
            // 'category_id' => 'nullable|exists:categories,id'
            'technologies'=> 'exists:technologies,id',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        $project = Project::create($data);

        if($request->has('technologies')) {
            $project->technologies()->attach($data['technologies']);
        }
        dd($data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::orderBy('name','ASC')->get();
        return view('admin.projects.edit', compact('project','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'string', Rule::unique('projects')->ignore($project->id)],
            'description' => 'nullable|min:5|string',
            // 'category_id' => 'nullable|exists:categories,id',
            'technologies'=> 'exists:technologies,id',
        ]);
        $data = $request->all();

        // if($post->title !== $data['title']) {
        $data['slug'] = Str::slug($data['title'], '-');
        // }

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            // $project->technologies()->sync([]);
            $project->technologies()->detach();
        }
        // dd($data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        
        $project->technologies()->sync([]);
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
