<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }
        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = ' in ' . $user->name;
        }
        // scrip diatas untuk memberikan tambahan title jikala kita masuk ke menu category atau penulis

        return view('posts', [
            "title" => "All Posts" . $title,
            "active" => 'posts',
            //"posts" => Post::all()
            "posts" => Post::latest()->filter(request(['search', 'category', 'user']))->paginate(7)->withQueryString()
            //latest menampilkan data berdasar data terbaru, fillter memanggil fungsi search pada model, paginate untuk hanya menampilkan 7 postingan 
        ]);
    }

    //route model banding
    public function show(Post $post) //variable $post harus sama denga var di web.php
    {
        return view('post', [
            "title" => "Single Post",
            "active" => 'posts',
            "post" => $post
        ]);
    }
}
