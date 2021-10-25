<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Posts.View', ['posts' => Post::orderby('created_at', 'desc')->paginate(100)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('Posts.Create', ['forums' => Forum::all('id','name'), 'authors' => User::all('id','name')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $post = new Post();
//        $post->title = $request->title;
//        $post->subtitle = $request->subtitle;
//        $post->body = $request->body;
//        $post->user()->associate(Auth::user());
//        $post->forum_id = $request->forum_id;
//        $post->save();
//        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $post = Post::find($id);
//        return view('Posts.Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $post = Post::find($id);
//        return view('Posts.Edit', ['post' => $post, 'forums' => Forum::all('id','name'), 'authors' => User::all('id','name')]);
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
//        $post = Post::find($id);
//        $post->title = $request->title;
//        $post->subtitle = $request->subtitle;
//        $post->body = $request->body;
//        $post->forum_id = $request->forum_id;
//        $post->user_id = $request->user_id;
//        $post->save();
//        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
