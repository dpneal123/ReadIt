<?php

namespace App\Http\Controllers;

use App\Models\UserForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserForumController extends Controller
{
//    public function join($forum) {
//        dd($forum);
////        $userforum = new UserForum();
////        $userforum->user_id = Auth::id();
////        $userforum->forum_id = $forum;
////        $userforum->save();
////        return redirect('/forums/'.$forum);
//    }
//
//    public function remove($forum) {
//        dd($forum);
////        $userforum = UserForum::where(['user_id' => Auth::id(), 'forum_id' => $forum])->get(1);
////        $userforum->delete();
////        return redirect('/forums/'.$forum);
//    }
//
//    public static function exists($user, $forum) {
//        return UserForum::where(['user_id' => $user, 'forum_id' => $forum])->exists();
//    }
}
