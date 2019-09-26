<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
}
