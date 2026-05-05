<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Models\Post;







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Mostar todos los posts de todos los usuarios en la pagina de inicio

    // Ruta para ver el formulario
    Route::get('/posts/create', [PostController::class, 'create']);
    //Ruta para mostrar los posts
    Route::get('/posts/index', [PostController::class, 'index']);

    
    // Ruta para recibir los datos del formulario (POST)
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::delete('/posts/{id}/delete', [PostController::class, 'delete']);
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/Panel', [AdminController::class, 'index'])->name('admin.adminPanel');

});

require __DIR__ . '/auth.php';













// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/posts/create', [PostController::class, 'create']);
// Route::get('/posts/{post}', [PostController::class, 'show']);






// Route::get('prueba', function () {
//     //crear un registro
//     // $post = new Post;
//     // $post->title = "Mi primer post3";
//     // $post->content = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas";
//     // $post->category = "Programacion";
//     // $post->save();

//     // return $post;

//     // $post = Post::find(1);  buscar pos id

//     //actualizar un registro
//     // $post = Post::where('title', 'Mi primer post')->first(); //buscar por titulo
//     // $post->title = "Mi primer post editado";
//     // $post->update();


//     // ordenar los registros

//     $post = Post::orderBy('id', 'desc')->get();
//     return $post;



//     // $post = Post::find(1);
//     // $post->delete();





// });
