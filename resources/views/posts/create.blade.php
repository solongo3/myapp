@extends('layouts.app')
@section('content')
    <h1>Create posts</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    {!! Form::open(['url' => 'foo/bar']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['class' => 'ckeditor form-control', 'placeholder' => 'Body Text']) }}
    </div>
    <div class = "form-group">
        {{Form::file('cover_images')}}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
