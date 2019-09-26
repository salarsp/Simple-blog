@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <p class="font-weight-normal">Write your changes:</p>
            <p class="font-weight-normal">User: {{$comment->user->name}}</p>
            <form action="{{url('admin/comments', ['id'=>$comment->id])}}" method="post">
                @csrf
                @method('put')
                <textarea required name="content" id="content" cols="1" rows="5"
                          class="form-control">{{$comment->content}}</textarea>
                <button class="btn btn-block btn-primary mt-2" type="submit">Send</button>
            </form>
        </div>
    </div>
@endsection