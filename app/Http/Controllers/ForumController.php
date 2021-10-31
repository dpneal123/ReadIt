<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::where('active', '=', '1')->orWhere('user_id', '=', Auth::id())->orderby('created_at', 'desc')->paginate(20);
        return view('Forums.View', ['forums' => $forums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Forums.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'active' => 'required'
        ]);

        $forum  = new Forum();
        $name = $request->name;
        $forum->name = $request->name;
        $forum->slug = str_replace(' ', '-', preg_replace('#[[:punct:]]#', '', strtolower($name)));
        $forum->description = $request->description;
        $forum->active = $request->active;
        $forum->author()->associate(Auth::user());
        $forum->save();
        return redirect()->route('forums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        $posts = Post::orderby('created_at', 'desc')->where('forum_id', '=', $forum->id)->get();
        $forums = Forum::orderby('name', 'asc')->paginate(10)->where('active', 1);
        return view('Forums.Show', ['posts' => $posts, 'forums' => $forums, 'current_forum' => $forum]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        return view('forums.edit', ['forum' => $forum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'active' => 'required'
        ]);

        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->active = $request->active;
        $forum->save();

        $posts = Post::orderby('created_at', 'desc')->where('forum_id', '=', $forum->id)->get();
        $forums = Forum::orderby('name', 'asc')->paginate(10)->where('active', 1);
        return view('Forums.Show', ['posts' => $posts, 'forums' => $forums, 'current_forum' => $forum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->route('forums.index');
    }
}
