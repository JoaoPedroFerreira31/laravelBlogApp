<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use \Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::latest()->withCount('comments')->get();

        return new PostCollection($posts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        $post->load(
            'author',
            'comments',
            'comments.user'
        )->loadCount('comments');

        return new PostResource($post);
    }

    /**
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create($validated);

        return new PostResource($post);
    }

    /**
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        if($post->author === Auth::user()->id) {

            $validated = $request->validated();

            $post->update($validated);

            return new PostResource($post);

        } else {
            return abort(403, 'You are not allowed to edit this post');
        }
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function fetchUserPosts()
    {
        $posts = Post::where('author', Auth::user()->id)->with('comments:id,post_id,comment,user_id', 'comments.user:id,name')->withCount('comments')->get();

        return new PostCollection($posts);
    }

    /**
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function fetchUserFriendsPosts()
    {
        $user = Auth::user();
        $user->load('followings');
        $friendsID = $user->followings->pluck('id');

        $posts = Post::whereIn('author', $friendsID)->with('comments', 'comments.user')->withCount('comments')->get();

        return new PostCollection($posts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if($post->author === Auth::user()->id) {

            $post->delete();

            return response()->noContent();

        } else {
            return abort(403, 'You are not allowed to delete this post');
        }
    }

    // public function update_game_formation(Request $request ,Game $game) {

    //     $this->authorize('update', $game);

    //     $rules = [
    //         'formation_png' => ['required|string'],
    //         'formation_json' => ['required|json']
    //     ];

    //     $request->validate([$rules]);

    //     $game->update([
    //         'formation_png' => $request->get('formation_png'),
    //         'formation_json' => $request->get('formation_json')
    //     ]);

    //     return new GameResource($game);
    // }

    // public function import(Request $request)
    // {
    //     $this->authorize('create', Game::class);

    //     $request->validate([
    //         'file' => ['required','mimes:csv,xls,xlsx,xlsm','max:2048'],
    //     ]);

    //     if ($request->hasfile('file')) {
    //         $nameSave = Str::uuid()->getHex();
    //         $extension = $request->file('file')->extension();
    //         $filenametostore = $nameSave.'.'.$extension;
    //         $folder = 'public/'.Auth::user()->club_id.'/import-files';

    //         $request->file('file')->storeAs('public/'.Auth::user()->club_id.'/import-files', $filenametostore);
    //         ImportExcelDataJob::dispatch($folder, $filenametostore, 'games', Auth::user()->club_id, Auth::user());
    //     }

    //     return response()->noContent();
    // }

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function game_attendances(Request $request, Game $game)
    // {
    //     $this->authorize('view-any', Game::class);

    //     return new GameAttendanceCollection(GameAttendance::where('game_id', $game->id)->with('game','player:id,name,short_name,photo')->get());
    // }

    // /**
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function game_statistics(Request $request, Game $game)
    // {
    //     return new GameStatisticCollection(GameStatistic::where('game_id', $game->id)->with('statistic')->get());
    // }

}
