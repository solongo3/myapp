@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:30%" src="/storage/cover_images/{{$post->cover_image}}">

    <div>
        {{$post->body}}
    </div>
    <hr>
        <small>Written on {{$post->created_at}}</small>
    <hr>
    @if(!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'DELETE']) !!}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
        @endif
    @endif
@endsection