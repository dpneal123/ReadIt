<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{

    public function _voteRedirect () {
        $requestURL = str_replace(App::make('url')->to('/'), '', URL::previous());

        if ($requestURL == '/posts') {
            return redirect()->route('posts.index');
        }
        if ($requestURL == '/my-posts') {
            return redirect()->route('posts.personal');
        }
        if ($requestURL == '/dashboard') {
            return redirect()->route('dashboard');
        }
        if ( substr($requestURL,  0, strrpos( $requestURL, '/')) == '/forums') {
            return redirect()->route('forums.show', substr($requestURL, strrpos( $requestURL, '/')+1));
        }
    }

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
        $posts = Post::select('posts.*')->orderby('posts.created_at', 'desc')->join('user_forums', function ($join) {
            $join->on('user_forums.forum_id', '=', 'posts.forum_id')
                ->where('user_forums.user_id', '=', Auth::id());
        })->paginate(100);
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
     * @param \Illuminate\Http\Request $request
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
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('Posts.Edit', ['post' => $post, 'forums' => Forum::all('id', 'name'), 'authors' => User::all('id', 'name')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

//    protected function voteExists($voteData)
//    {
//        return PostVote::where([
//            'post_id' => $voteData['post_id'],
//            'user_id' => $voteData['user_id'],
//        ])->exists();
//    }
//
//    protected function addVote($post_id, $user_id, $isUp)
//    {
//        $postVote = new PostVote();
//        $postVote->post_id = $post_id;
//        $postVote->user_id = $user_id;
//        $postVote->isUp = $isUp;
//        $postVote->save();
//        return $this->_voteRedirect();
//    }
//
//    public function upVote($post)
//    {
//        $user = Auth::id();
//
//        if ($this->voteExists([
//            'post_id' => $post,
//            'user_id' => $user
//        ])) {
//            $postVote = PostVote::where([
//                'post_id' => $post,
//                'user_id' => $user
//            ])->get();
//
//            if ($postVote[0]->isUp == 0) {
//                $postVote[0]->delete();
//                return $this->addVote($post, $user, 1);
//            }
//            elseif ($postVote[0]->isUp == 1) {
//                $postVote[0]->delete();
//                return $this->_voteRedirect();
//            }
//            else {
//                return redirect()->back();
//            }
//        } else {
//            return $this->addVote($post, $user, 1);
//        }
//    }
//
//    public function downVote($post)
//    {
//        $user = Auth::id();
//
//        if ($this->voteExists([
//            'post_id' => $post,
//            'user_id' => $user
//        ])) {
//            $postVote = PostVote::where([
//                'post_id' => $post,
//                'user_id' => $user
//            ])->get();
//            if ($postVote[0]->isUp == 1) {
//                $postVote[0]->delete();
//                return $this->addVote($post, $user, 0);
//            }
//            elseif ($postVote[0]->isUp == 0) {
//                $postVote[0]->delete();
//                return $this->_voteRedirect();
//            }
//            else {
//                return redirect()->back();
//            }
//        } else {
//            return $this->addVote($post, $user, 0);
//        }
//    }
}
