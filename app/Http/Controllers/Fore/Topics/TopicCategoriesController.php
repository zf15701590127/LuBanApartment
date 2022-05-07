<?php

namespace App\Http\Controllers\Fore\Topics;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Http\Controllers\Controller;

class TopicCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(TopicCategory $topicCategory)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = Topic::where('topic_category_id', $topicCategory->id)->with('user', 'topicCategory')->paginate(20);
        // 传参变量话题和分类到模版中
        return view('fore.topics.topics.index', compact('topics', 'topicCategory'));
    }
}
