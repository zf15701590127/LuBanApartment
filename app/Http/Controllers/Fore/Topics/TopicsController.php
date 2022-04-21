<?php

namespace App\Http\Controllers\Fore\Topics;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Http\Requests\Fore\TopicRequest;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $topics = Topic::with('user', 'topicCategory')->paginate(15);

        return view('fore.topics.topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('fore.topics.topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $topicCategories = TopicCategory::all();
        return view('fore.topics.topics.create_and_edit', compact('topic', 'topicCategories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->order = 0;
        $topic->save();

        return redirect()->route('fore.topics.topics.show', $topic->id)->with('success', '帖子创建成功！');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $topicCategories = TopicCategory::all();
        return view('fore.topics.topics.create_and_edit', compact('topic', 'topicCategories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());
        return redirect()->route('fore.topics.topics.show', $topic->id)->with('success', '更新成功！');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        return redirect()->route('fore.topics.topics.index')->with('success', '成功删除！');
    }

    // 话题的富文本编辑器图片上传
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败
        $data = [
            'success' => false,
            'msg' => '上传失败！',
            'file_path' => ''
        ];

        // 判断是否有文件上传，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "上传成功！";
                $data['success'] = true;
            }
        }

        return $data;
    }
}
