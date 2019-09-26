@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @php(session()->forget('message'))
        @php(session()->forget('type'))
    @endif
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <h5 class="text-center">Menu</h5>
            <div class="list-group">
                <a href="/admin/posts" class="list-group-item btn btn-default">Posts</a>
                <a href="/admin/comments" class="list-group-item btn btn-default">Comments</a>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-6">
            <div class="row">
                <div class="col-12">
                    <h3>Comments Listing</h3>
                </div>
            </div>
            <p class="text-justify font-weight-normal">All of existing comments are show here.</p>
            <table class="table m-0">
                <thead>
                <tr>
                    <th scope="col" width="1" class="border-top-0">#</th>
                    <th scope="col" class="border-top-0">Name</th>
                    <th scope="col" class="border-top-0">Comment</th>
                    <th scope="col" class="border-top-0 text-right">Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $key => $comment)

                    <tr>
                        <td class=" align-middle text-center">
                            <span class="user-initials bg-success-light25 text-success">{{$key+1}}</span>
                        </td>
                        <td class="align-middle">
                            <div class="weight-400">{{ $comment->user->name }}</div>
                        </td>
                        <td class="align-middle">
                            <div class="weight-400">{!! substr($comment->content, 0, 50) !!}...</div>
                        </td>
                        <td class="align-middle text-right">
                            <a href="/post/{{$comment->post->id}}" target="_blank"
                               class="btn btn-outline-dark btn-sm"
                               style="font-size: 11.5pt">Show</a>&nbsp;
                            <a href="/admin/comments/{{$comment->id}}/edit"
                               class="btn btn-outline-primary btn-sm"
                               style="font-size: 11.5pt">Edit</a>&nbsp;
                            <form action="{{url('admin/comments', ['id'=>$comment->id])}}" method="post"
                                  class="btn btn-outline-danger btn-sm" style="cursor: pointer; font-size: 11.5pt"
                                  onclick="this.submit();">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                Delete
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $comments->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}</div>
    </div>

@endsection