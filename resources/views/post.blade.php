@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <img class="card-img-top" src="{{asset($post->image)}}" alt="{{$post->title}}">

                    <div class="card-body">
                        <h4>{{$post->title}}</h4>

                        {{$post->content}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 id="add" class="text-center">Comments</h4>
                        <hr>
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
                        @auth
                            <p class="font-weight-normal">Write your comment:</p>
                            <form action="{{route('new_comment')}}" method="post">
                                @csrf
                                <input type="hidden" hidden name="id" value="{{$post->id}}">
                                <input id="rep2" type="hidden" hidden name="reply">
                                <div id="replyArea" class="mb-1" style="display: none">
                                    <b>Replying to:</b>
                                    <input style="display: none"
                                           onclick="RemoveReply()" type="button"
                                           id="reply" class="btn btn-light"
                                           data-toggle="tooltip" data-placement="top" title="Click to remove reply">
                                </div>
                                <textarea required name="content" id="content" cols="1" rows="5"
                                          class="form-control"></textarea>
                                <button class="btn btn-block btn-primary mt-2" type="submit">Send</button>
                            </form>
                        @else
                            <p class="font-weight-bold text-secondary"><a href="{{route('login')}}">Login</a> to your account or <a href="{{route('register')}}">Register</a> if you don't have an account to send comment.</p>
                        @endauth
                        <div class="my-3">
                            @foreach($post->comments as $comment)
                                @if($comment->reply_to_comment_id == '')
                                    <div class="comment p-3 my-2">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-2">
                                                <img class="img img-thumbnail rounded-circle"
                                                     src="{{asset('images/user.png')}}"
                                                     alt="{{$comment->user->name}}">
                                            </div>
                                            <div class="col-sm-8 com-md-10">
                                                <p class="font-weight-bold">{{$comment->user->name}}</p>
                                                <p class="font-weight-normal">{{$comment->content}}</p>
                                                <a class="btn btn-link" onclick="ReplyTo('{{$comment->id}}')"
                                                   href="#add">Reply</a></div>
                                        </div>
                                        @php($commentId = $comment->id)
                                        @foreach($post->comments as $comment)
                                            @if($comment->reply_to_comment_id == $commentId)
                                                <div class="container">
                                                    <hr class="ml-4">
                                                    <div class="row ml-4">
                                                        <div class="col-sm-4 col-md-2">
                                                            <img class="img img-thumbnail rounded-circle"
                                                                 src="{{asset('images/user.png')}}"
                                                                 alt="{{$comment->user->name}}">
                                                        </div>
                                                        <div class="col-sm-8 com-md-10">
                                                            <p class="font-weight-bold">{{$comment->user->name}}</p>
                                                            <p class="font-weight-normal">{{$comment->content}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function ReplyTo(destination) {
            document.getElementById('reply').value = destination;
            document.getElementById('rep2').value = destination;
            document.getElementById('reply').style.display = '';
            document.getElementById('replyArea').style.display = '';
        }

        function RemoveReply() {
            document.getElementById('reply').value = '';
            document.getElementById('rep2').value = '';
            document.getElementById('reply').style.display = 'none';
            document.getElementById('replyArea').style.display = 'none';
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
