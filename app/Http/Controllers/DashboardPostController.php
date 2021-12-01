<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\Category;
use App\Models\post as ModelsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Validated;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Post::where('user_id', auth()->user()->id)->get();

        return view('dashboard.posts.index', [
            'posts' => post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // ddd($request);    dump, die, debug
        // cara mengirim filenya
        // ambil file yang namanya image, lalu upload dan simpan di folder post-images
        // return $request->file('image')->store('post-images');
        // post-images otomatis terbikin saat kita create
        // storage - app - post-images

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:3000',
            'body' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);
        // // Str:limit -> untuk membatasi data yang akan dimasukan
        // // strip_tags -> karena menggunakan trix kita harus menghilangkan tag html nya menggunakan strip_tags

        post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New Post has been Added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:3000',
            'body' => 'required'
        ];


        
        // Kalau slug nya tidak mau kita ganti, maka slug nya harus di keluarin dari rules, karena bentuknya yang unique
        
        // Makanya pakai pengkondisian, kalau slug nya mau di ganti dengan yang baru maka slug yang baru harus beda dan gak boleh kosong
        
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        
        $validatedData = $request->validate($rules);


        
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);
        

        post::where('id', $post->id)
                ->update($validatedData);

        // Update validated data dimana id nya sama dengan id sebelumnya

        return redirect('/dashboard/posts')->with('success', 'Post has been Updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {

        if ($post->image) {
            Storage::delete($post->image);
        }

        post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been Deleted!!!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(post::class, 'slug', $request->title);
        // return sebagai response/value dalam bentuk json
        return response()->json(['slug'=> $slug]);
    }
}
