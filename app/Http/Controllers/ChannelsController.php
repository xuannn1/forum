<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::latest()->get();

        return view('channels.index', compact('channels'));
    }

    public function store(Request $request)
    {
        $channel = Channel::create([
            'name' => request('name'),
            'slug' => request('slug')
        ]);
        return back();
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();
        return back();
    }

    public function update(Channel $channel)
    {
        $channel->update([
            'name' => request()->name,
            'slug' => request()->slug
        ]);
        return back();
    }
}
