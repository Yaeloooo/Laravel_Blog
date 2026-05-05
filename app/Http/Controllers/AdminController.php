<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

        public function index()
        {
            $posts = Post::with('user')->latest()->get();
            return view('admin.adminPanel', compact('posts') );
        }


}
