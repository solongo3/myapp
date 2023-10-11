<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); // Use Eloquent to fetch posts and paginate results
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_images' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('cover_images')) {
            // Get the uploaded file
            $file = $request->file('cover_images');
            // Get the filename with extension
            $fileNameWithExt = $file->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload image
            $path = $file->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore; // Set the cover image
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if (Auth::user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        
        $post = Post::find($id);
        // Check for correct user
        if (Auth::user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if ($request->hasFile('cover_images')) {
            // Get the uploaded file
            $file = $request->file('cover_images');
            // Get the filename with extension
            $fileNameWithExt = $file->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload image
            $path = $file->storeAs('public/cover_images', $fileNameToStore);
            $post->cover_image = $fileNameToStore; // Update the cover image
        }

        $post = Post::find($id);
        $post -> title = $request->input('title');
        $post->body =$request->input('body');
        if($request->hasfile('cover_images')){
            $post->cover_image=$fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if (Auth::user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        // Delete the associated cover image file
        if ($post->cover_images != 'noimage.jpg') {
            Storage::delete('public/cover_images/' . $post->cover_images);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'The post has been deleted.');
    }
}
