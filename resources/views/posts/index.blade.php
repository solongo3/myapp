@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="/posts/create" class="btn btn-secondary">Create Post</a></li>
    </ul>    
    <div class="empty-row"></div>
    @if(count($posts) >= 1)
        @foreach ($posts as $post)
            <div class="well">
                <div class = "row">
                    <div class="col-md-4 col-sm-4">
                        <img style = "width:70%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}"> {{$post->title}} </a></h3>
                        <small> Written on {{$post->created_at}}</small>
                    </div>
                </div>
                
            </div>
            <div class="empty-row"></div>
         @endforeach
         {{-- {{$posts->links()}} --}}
    @else
        <p>Sorry, no posts found </p>
    @endif
@endsection
