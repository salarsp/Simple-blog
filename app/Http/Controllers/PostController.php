<?php

namespace App\Http\Controllers;

use App\Post;
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
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('posts', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $title = $request->get('title');
            $content = $request->get('content');
            $image = $request->file('file');

            if ($image != null) {
                $rand = md5(uniqid(rand(), true));
                $image->move('images/', $rand . '.' . $image->getClientOriginalExtension());
                $imagePath = 'images/' . $rand . '.' . $image->getClientOriginalExtension();
            }
            $post = new Post();
            $post->title = $title;
            $post->content = $content;
            $post->image = $imagePath;
            $post->save();

            session()->put('message', 'New post sent successfully.');
            session()->put('type', 'success');
        } catch (\Exception $exception) {
//            return to main page if post does not exist
            session()->put('message', 'Failed to send post.');
            session()->put('type', 'warning');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
//            find post and show it to user
            $post = Post::findOrFail($id);
            return view('post', compact('post'));
        }catch (\Exception $exception){
//            return to main page if post does not exist
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
