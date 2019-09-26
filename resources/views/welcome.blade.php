@extends('layouts.app')

@section('content')
    <div class="row">
        {{--Listing all of post by pagination--}}
        @foreach($posts as $post)
            <div class="col-4 my-2">
                <div class="card">
                    <img src="{{$post->image}}" class="card-img-top" alt="{{$post->title}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text text-justify">{{substr($post->content, 0, 147)}}...</p>
                        <a href="/post/{{$post->id}}" class="btn btn-primary">More details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
@endsection