<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->paginate(10);
        return view('comments', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('edit-comment', compact('comment'));
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
        try {
//            getting comment content
            $content = $request->get('content');

            $comment = Comment::findOrFail($id);
            $comment->content = $content;
            $comment->save();

            session()->put('message', 'Your changes was successfully saved on comment.');
            session()->put('type', 'success');
        } catch (\Exception $exception) {
//            return to main page if post does not exist
            session()->put('message', 'Failed to edit comment.');
            session()->put('type', 'warning');
        }
        return redirect('admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            session()->put('message', 'Selected comment successfully removed.');
            session()->put('type', 'success');
        } catch (\Exception $exception) {
//            return to main page if post does not exist
            session()->put('message', 'Failed to remove comment.');
            session()->put('type', 'warning');
        }
        return redirect('admin/comments');
    }
}
