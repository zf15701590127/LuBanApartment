<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\ProjectRequest;
use App\Models\Project;
use Auth;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = Project::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $projects = $builder->paginate(10);

        return view('back.configs.projects.index', [
            'projects' => $projects,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(Project $project)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.projects.create_and_edit', ['project' => $project]);
    }

    public function store(ProjectRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        Project::create($request->all());

        return redirect()->route('back.configs.projects.index')->with('success', '添加成功！');
    }

    public function edit(Project $project)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.projects.create_and_edit', ['project' => $project]);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('is_admin', Auth::user());

        $project->update($request->all());

        return redirect()->route('back.configs.projects.index')->with('success', '修改成功！');
    }

    public function destroy(Project $project)
    {
        $this->authorize('is_admin', Auth::user());

        $project->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
