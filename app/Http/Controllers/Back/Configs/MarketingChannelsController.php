<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\MarketingChannelRequest;
use App\Models\MarketingChannel;
use Auth;

class MarketingChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = MarketingChannel::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $marketingChannels = $builder->paginate(10);

        return view('back.configs.marketingChannels.index', [
            'marketingChannels' => $marketingChannels,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(MarketingChannel $marketingChannel)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.marketingChannels.create_and_edit', ['marketingChannel' => $marketingChannel]);
    }

    public function store(MarketingChannelRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        MarketingChannel::create($request->all());

        return redirect()->route('back.configs.marketingChannels.index')->with('success', '添加成功！');
    }

    public function edit(MarketingChannel $marketingChannel)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.marketingChannels.create_and_edit', ['marketingChannel' => $marketingChannel]);
    }

    public function update(MarketingChannelRequest $request, MarketingChannel $marketingChannel)
    {
        $this->authorize('is_admin', Auth::user());

        $marketingChannel->update($request->all());

        return redirect()->route('back.configs.marketingChannels.index')->with('success', '修改成功！');
    }

    public function destroy(MarketingChannel $marketingChannel)
    {
        $this->authorize('is_admin', Auth::user());

        $marketingChannel->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
