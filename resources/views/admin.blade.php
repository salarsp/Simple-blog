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
        <div class="col-lg-9 col-md-8 col-sm-6"><p class="font-weight-bold text-center">Choose an item</p></div>
    </div>
@endsection