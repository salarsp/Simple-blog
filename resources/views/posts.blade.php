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
            </div></div>
        <div class="col-lg-9 col-md-8 col-sm-6">
            <div class="row">
                <div class="col-6">
                    <h3>Posts Listing</h3>
                </div>
                <div class="col-6">
                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-block btn-primary">Add new
                        Post
                    </button>
                </div>
            </div>
            <p class="text-justify font-weight-normal">All of existing posts are show here.</p>
            @foreach($posts as $post)
                <div class="list-group">
                    <a href="/admin/posts/{{$post->id}}" class="list-group-item btn btn-default">
                        {{ $post->title }}
                    </a>
                </div>
            @endforeach
            {{ $posts->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
        </div>
    </div>

    {{--Modal to create new post--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('posts')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter post title here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea rows="5" name="content" class="form-control" id="content"
                                          placeholder="Enter your post content here"></textarea>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Image</span>
                            </div>
                            <div class="custom-file">
                                <input name="file" type="file" class="custom-file-input" id="inputGroupFile01"
                                       aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection