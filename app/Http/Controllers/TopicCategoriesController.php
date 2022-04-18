<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\TopicCategory;

class TopicCategoriesController extends Controller
{
    public function show(TopicCategory $topicCategory)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = Topic::where('topic_category_id', $topicCategory->id)->with('user', 'topicCategory')->paginate(20);
        // 传参变量话题和分类到模版中
        return view('topics.index', compact('topics', 'topicCategory'));
    }
}
