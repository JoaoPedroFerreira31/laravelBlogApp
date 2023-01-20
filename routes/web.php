<?php

use Illuminate\Http\Request;
use App\Models\User;
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

    Route::get('/dashboard', function () {
        return view('dashboard');
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

        return view('profile', [
            'user' => $user,
        ]);

    })->name('profile');

});


require __DIR__.'/auth.php';
