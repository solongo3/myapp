@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                 {{ session('status') }}
                            </div>
                        @endif
                        <a href = "/posts/create" class = "btn btn-primary">Create post</a>
                    <p>{{ __('Your blog posts') }}</p>
                    @if(count($posts)>0)
                        <table class = "table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th> </th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{$post->title}}</th>
                                    <td> <a href = "/posts/{{$post->id}}/edit" class = "btn btn-default" >Edit</a> </td>
                                    <td>
                                        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'DELETE']) !!}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Sorry, you have no post</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
