<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('/posts', PostController::class);

    Route::get('/dashboard', function () {

        $user = Auth::user();
        $user->load('followings');
        $friendsID = $user->followings->pluck('id');

        $posts = Post::latest()->withCount('comments')->get();
        $userPosts = Post::where('author', $user->id)->with('comments', 'comments.user')->withCount('comments')->get();
        $userFriendsPosts = Post::whereIn('author', $friendsID)->with('comments', 'comments.user')->withCount('comments')->get();

        return view('dashboard', [
            'posts' => $posts,
            'userPosts' => $userPosts,
            'userFriendsPosts' => $userFriendsPosts
        ]);

    })->name('dashboard');

    Route::get('/profile/{user}', function (Request $request) {
        $user = User::find($request['user']);

        $user->load(
            'posts',
            'posts.comments',
            'posts.comments.user',
            'followers',
            'followings',
            'pendingRequests'
        )->loadCount('followers', 'followings', 'pendingRequests', 'posts');

        $user->posts->loadCount('comments');

        return view('profile', [
            'user' => $user,
        ]);

    })->name('profile');

});


require __DIR__.'/auth.php';
