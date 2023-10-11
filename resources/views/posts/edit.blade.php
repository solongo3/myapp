@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'PUT',  'enctype'=>'multipart/form-data']) !!}
        {{-- {!! Form::open(['url' => 'foo/bar']) !!} --}}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', $post->body, ['class' => 'ckeditor form-control', 'placeholder' => 'Body Text']) }}
        </div>
        <div class = "form-group">
            {{Form::file('cover_images')}}
        </div>
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>
@endsection
