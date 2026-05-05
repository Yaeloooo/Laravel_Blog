<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index()
    {

        //va a mostar los post del usuario que esta logueado

        $posts = Post::where('user_id', auth()->id())->get();
        return view('posts.index', compact('posts') );

    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request){
        //validar los datos
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        //crear un nuevo post
        $post = new Post;
        $post->user_id = auth()->id();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->save();

        return redirect('/posts/index')->with('success', 'Post creado exitosamente');
    }


    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post') );
    }



    public function delete($id){
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts/index')->with('success', 'Post eliminado exitosamente');
    }


    public function edit($id){
        $post = Post::find($id);

        return view('posts.edit', compact('post') );
    }

    public function update(Request $request, $id){
        //validar los datos
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        //actualizar el post
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->update();

        return redirect('/posts/index')->with('success', 'Post actualizado exitosamente');
    }



}
