<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id','desc')->paginate(9);
        return view('welcome', compact('posts'));
    }

    public function post($id){
        try{
//            find post and show it to user
            $post = Post::findOrFail($id);
            return view('post', compact('post'));
        }catch (\Exception $exception){
//            return to main page if post does not exist
            return redirect('/');
        }
    }

    public function add(Request $request)
    {
        try {
//            getting post id and comment and replying comment id
            $id = $request->get('id');
            $content = $request->get('content');
            $reply = $request->get('reply');

            $comment = new Comment();
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $id;
            $comment->content = $content;
            $comment->reply_to_comment_id = $reply;
            $comment->save();

            session()->put('message', 'Your message sent successfully.');
            session()->put('type', 'success');
        } catch (\Exception $exception) {
//            return to main page if post does not exist
            session()->put('message', 'Failed to send comment.');
            session()->put('type', 'warning');
        }
        return back();
    }

//     Admin Panel function
    public function admin(){
        $posts = Post::orderBy('id','desc')->paginate(10);
        $comments = Comment::orderBy('id','desc')->paginate(10);
        return view('admin', compact('posts', 'comments'));
    }
}
