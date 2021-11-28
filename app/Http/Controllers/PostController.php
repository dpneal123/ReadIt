<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $posts = Post::orderby('created_at', 'desc')->paginate(10);
        $forums = Forum::orderby('created_at', 'desc')->where('active', 1)->take(10)->get();
        return view('dashboard', ['posts' => $posts, 'forums' => $forums]);
    }

    public function personal()
    {
        $user_id = Auth::user()->getAuthIdentifier();
        $posts = Post::orderby('created_at', 'desc')->where('user_id', $user_id)->paginate(20);
        $forums = Forum::orderby('created_at', 'desc')->where('active', 1)->take(10)->get();
        return view('Posts.View', ['posts' => $posts, 'forums' => $forums]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderby('created_at', 'desc')->paginate(100);
        $forums = Forum::orderby('created_at', 'desc')->where('active', 1)->take(10)->get();
        return view('Posts.View', ['posts' => $posts, 'forums' => $forums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forums = Forum::orderby('name', 'desc')->where('active', '1')->get();
        return view('Posts.Create', ['forums' => $forums]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->author()->associate(Auth::user());
        $post->forum_id = $request->forum_id;
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('Posts.Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('Posts.Edit', ['post' => $post, 'forums' => Forum::all('id','name'), 'authors' => User::all('id','name')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->forum_id = $request->forum_id;
        $post->save();
        return view('Posts.Show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
