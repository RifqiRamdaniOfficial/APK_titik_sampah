<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DaftarTugasController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardReqController;
use App\Http\Controllers\AdminReqController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DahsboardRegionController;
use App\Http\Controllers\AdminUser;
use App\Http\Controllers\PDFController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);


Route::get('/about', function () { //dimana kita menulis about di url maka 
    return view('about', [
        "title" => "About",
        'active' => 'about',
    ]);          //tampilkan view about
});

Route::get('/posts', [PostController::class, 'index']);

//menampilkan halaman singgle post
//{post::slug} menampilkan data berdasar slug
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//route halaman macam macam categori
Route::get('categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

//raoute ke halaman jenis categori
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [ //menggunakan halaman post untuk menampilkan categori 
        'title' => "Post By Category : $category->name",
        'active' => 'categories',
        'posts' => $category->posts->load('category', 'user'), //load untuk menangani looping yang terlalu banyak
    ]);
});

//menampilkan halaman berdasar satu author 
Route::get('/users/{user:username}', function (User $user) {
    return view('posts', [ //menggunakan halaman post untuk menampilkan author/penulis 
        'title' => "Post By Penulis : $user->name",
        'active' => 'posts',
        'posts' => $user->posts->load('category', 'user'),
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/dashboard/reqs', [AdminReqController::class, 'tampil'])->middleware('guest');
//midleware guest menjadi tanda bahwa kita sudah login dan tidak bisa kembali ke halaman login sebelum logout (edit dulu RouteServiceProvider untuk pindahkan halamannya ke route kita)
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logut', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard/tugas', [DaftarTugasController::class, 'index'])->middleware('auth');
Route::get('/dashboard/riwayat', [RiwayatController::class, 'index'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth'); //hanya bisa diakses oleh orang yang sudah login


Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::get('/dashboard/reqs/checkSlug', [DashboardReqController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
Route::resource('/dashboard/reqs', DashboardReqController::class)->middleware('auth');
Route::resource('/dashboard/admin_reqs', AdminReqController::class)->middleware('admin');

Route::resource('/dashboard/users', AdminUser::class)->middleware('admin');
Route::resource('/dashboard/regions', DahsboardRegionController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

Route::get('/dashboard/reports', [ReportController::class, 'index'])->name('dashboard.reports.index');
Route::get('/reqs/export', [ReportController::class, 'export'])->name('reqs.export');
Route::get('/dashboard/export-pdf', [PDFController::class, 'exportPDF'])->name('exportPDF');
Route::get('/dashboard/filter', [ReportController::class, 'filterReports'])->name('dashboard.filter');
