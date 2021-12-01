<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Category;
use App\Models\User;

class postController extends Controller
{
    public function index()
    {
        // $posts = post::latest();
        // if (request('search')) {
        //     $posts->where('title', 'like', '%' . request('search') . '%' )
        //         ->orWhere('body', 'like', '%' . request('search') . '%' );
        // }

        $title = '';

        if (request('category')) 
        {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) 
        {
            $author = User::firstWhere('username', request('author'));
            $title = ' By ' . $author->name;
        }

        return view('posts', [
            "title" => "All Posts" . $title ,
            "active" => "posts",
            // "posts" => post::all()
            "posts" => post::latest()->Filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    //tulis nama model lalu tuliskan nama var yang sama dengan di web.php
    public function show(post $post)
    {
        return view('post', [
            "title" => "Singel Post",
            "active" => "posts",
            "post" => $post
        ]); 
    }
}
