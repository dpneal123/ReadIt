<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use App\Models\UserForum;
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
        $forums = Forum::where('active', '=', '1')->orWhere('user_id', '=', Auth::user()->getAuthIdentifier())->orderby('created_at', 'desc')->paginate(20);
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

            $forum = new Forum();
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
        $posts = Post::orderby('created_at', 'desc')->where('forum_id', '=', $forum->id)->paginate(10);
        $forums = Forum::orderby('name', 'asc')->where('active', 1)->take(10)->get();
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
//        $request->validate([
//            'name' => 'required',
//            'description' => 'required',
//            'active' => 'required'
//        ]);

//        if (Auth::id() == $forum->user_id) {
            $name = $request->name;

            $forum->name = $request->name;
            $forum->slug = str_replace(' ', '-', preg_replace('#[[:punct:]]#', '', strtolower($name)));
            $forum->description = $request->description;
            $forum->active = $request->active;
            $forum->save();
//        }
        return redirect()->route('forums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
//        if (Auth::id() == $forum->user_id) {
            $forum->delete();
//        }
        return redirect()->route('forums.index');
    }

    public function join($forum) {
        $userforum = new UserForum();
        $userforum->user_id = Auth::id();
        $userforum->forum_id = $forum;
        $userforum->save();
        return redirect('/forums/'.$forum);
    }

    public function remove($forum) {
        $userforum = UserForum::where(['user_id' => Auth::id(), 'forum_id' => $forum])->get();
        $userforum[0]->delete();
        return redirect('/forums/'.$forum);
    }

    public static function exists($forumData) {
        return UserForum::where([
            'forum_id' => $forumData['forum_id'],
            'user_id' => $forumData['user_id'],])->exists();
    }

}
