<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Tag;

class PostController extends Controller
{
    private $validateRules;

    public function __construct()
    {
    
        $this->validateRules = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'path_image'=> 'image'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        $request->validate($this->validateRules);
        $data = $request->all();

        $path = Storage::disk('public')->put('images', $data['path_image']);

        $newPost = new Post;
        $newPost->title = $data['title'];
        $newPost->body = $data['body'];
        $newPost->user_id = $idUser;
        $newPost->published = $data['published'];
        $newPost->slug = Str::finish(Str::slug($newPost->title), rand(1, 1000000));
        $newPost->path_image = $path;

        $saved = $newPost->save();
        if(!$saved) {
            return redirect()->back();
        } 
        
        $newPost->tags()->attach($data['tags']);

        
        return redirect()->route('posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {    
        $post = Post::where('slug', $slug)->first();

        $comments = Comment::where('post_id', $post->id)->get();

        return view('admin.posts.show', compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        $data = [
            'tags' => $tags,
            'post' => $post,
        ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
       $idUser = Auth::user()->id;
        if(empty($post)){
            abort(404);
        }
        
        if($post->user->id != $idUser){
            abort(404);
        }

        $request->validate($this->validateRules);
        $data = $request->all();

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->published = $data['published'];
        $post->slug = Str::finish(Str::slug($post->title), rand(1, 1000000));

        $updated = $post->update();

        if (!$updated) {
            return redirect()->back();
        }

        $post->tags()->sync($data['tags']);

        return redirect()->route('posts.show', $post->slug); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(empty($post)) {
            abort(404);
        }
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index');
    }
}
