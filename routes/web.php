<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\postController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // Laravel akan mencarikan di folder view yang namanya welcome 
//     return view('welcome');
// });

Route::get('/', function () {
    // return 'Halaman Home';
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Puja Maulida Herwanto",
        "email" => "pujamaulidaherwanto@smkwikrama.sch.id",
        "image" => "Puja Maulida.jpg"
    ]);
});

Route::get('/posts', [postController::class , 'index']);

//halaman single post
// {slug} => wild card

// mencari data yang id nya ...
// Route::get('/posts/{slug}', [postController::class , 'show']);

Route::get('/posts/{post:slug}', [postController::class , 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        "active" => "categories",
        'categories' => Category::all()
    ]);
});

// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => "Post By Category : $category->name",
//         "active" => "categories",
//         'posts' => $category->posts->load(['category', 'author'])
//     ]);
// });

// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'active' => "home",
//         'title' => "Post By Author : $author->name",
//         'posts' => $author->posts->load(['category', 'author'])
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// abis pasang middleqare('guest) Jangan lupa ganti di RouteServiceProvider 
// Karena kalau user udh login, dan mau ke page login lg default middleware nya me redirect ke halaman home

//pakai name('login') agar user yang belum login tidak bisa masuk ke halaman dashboard atau halaman akun pribadi
// untuk selengkapnya liat di file middleware->Authenticate.php

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function ()
{
    return view('dashboard.index');

})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
// Setiap halaman jika di arahkan ke url /dashboar/posts dengan method get akan di arahkan ke index
// Setiap halaman jika di arahkan ke url /dashboar/posts dengan method post akan di arahkan ke store
// Setiap halaman jika di arahkan ke url /dashboar/posts dengan method put akan di arahkan ke update
// Setiap halaman jika di arahkan ke url /dashboar/posts dengan method delete akan di arahkan ke destroy

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');