<?php

namespace App\Http\Controllers\Back\Configs;

use Illuminate\Http\Request;
use App\Http\Requests\Back\TopicCategoryRequest;
use App\Models\TopicCategory;
use App\Http\Controllers\Controller;
use Auth;

class TopicCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = TopicCategory::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $topicCategories = $builder->paginate(10);

        return view('back.configs.topicCategories.index', [
            'topicCategories' => $topicCategories,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(TopicCategory $topicCategory)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.topicCategories.create_and_edit', ['topicCategory' => $topicCategory]);
    }

    public function store(TopicCategoryRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        TopicCategory::create($request->all());

        return redirect()->route('back.configs.topicCategories.index')->with('success', '添加成功！');
    }

    public function edit(TopicCategory $topicCategory)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.topicCategories.create_and_edit', ['topicCategory' => $topicCategory]);
    }

    public function update(TopicCategoryRequest $request, TopicCategory $topicCategory)
    {
        $this->authorize('is_admin', Auth::user());

        $topicCategory->update($request->all());

        return redirect()->route('back.configs.topicCategories.index')->with('success', '修改成功！');
    }

    public function destroy(TopicCategory $topicCategory)
    {
        $this->authorize('is_admin', Auth::user());

        $topicCategory->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
