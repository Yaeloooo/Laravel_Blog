<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'content'  => 'required',
            'category' => 'required'
        ]);

        $post = new Post;
        $post->user_id = auth()->id();
        $post->title    = $request->title;
        $post->content  = $request->content;
        $post->category = $request->category;
        $post->save();

        // ✅ NUEVO: responde JSON si viene de AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'post'    => $post,
                'message' => 'Post creado exitosamente'
            ], 201);
        }

        return redirect('/posts/index')->with('success', 'Post creado exitosamente');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function delete(Request $request, $id)
    {
        $post = Post::find($id);

        // ✅ NUEVO: verifica que el post le pertenece al usuario
        if ($post->user_id !== auth()->id()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado'
                ], 403);
            }
            return redirect('/posts/index')->with('error', 'No autorizado');
        }

        $post->delete();

        // ✅ NUEVO: responde JSON si viene de AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Post eliminado exitosamente'
            ]);
        }

        return redirect('/posts/index')->with('success', 'Post eliminado exitosamente');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'    => 'required',
            'content'  => 'required',
            'category' => 'required'
        ]);

        $post = Post::find($id);

        // ✅ NUEVO: verifica que el post le pertenece al usuario
        if ($post->user_id !== auth()->id()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado'
                ], 403);
            }
            return redirect('/posts/index')->with('error', 'No autorizado');
        }

        $post->title    = $request->title;
        $post->content  = $request->content;
        $post->category = $request->category;
        $post->update();

        // ✅ NUEVO: responde JSON si viene de AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'post'    => $post,
                'message' => 'Post actualizado exitosamente'
            ]);
        }

        return redirect('/posts/index')->with('success', 'Post actualizado exitosamente');
    }
}
