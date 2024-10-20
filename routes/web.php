<?php

use App\Models\Company;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

//home page
Route::get('/', function () {
    $posts = Post::all();
    return view('index', ['posts'=> $posts]);
});

//register, login as user and login as admin
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class,'logout']);
Route::post('/login', [UserController::class,'login']);
Route::get('/apply', function(){return view('apply');});
Route::get('/admin-crud', function () {
    $posts = Post::all();
    $company = Company::all();
    $posts = Post::with('company')->get();
    return view('admin', compact('posts', 'company'));
});

//admin
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class,'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class,'editPost']);
Route::delete('/delete-post/{post}', [PostController::class,'deletePost']);

//user
Route::get('/apply/{post}', [PostController::class,'showApplyScreen']);
Route::post('/apply/{post}', [PostController::class,'applyPost']);
